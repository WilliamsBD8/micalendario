<?php

namespace App\Controllers;

use App\Models\CalendaryTaxes;
use App\Models\CategoryTax;
use App\Models\TaxCalendar;
use App\Models\Company;
use App\Models\User;
use App\Models\Password;
use App\Models\CompanyNotification;

use CodeIgniter\Exceptions\PageNotFoundException;

use CodeIgniter\API\ResponseTrait;

class HomeController extends BaseController
{
	use ResponseTrait;

	public function home()
	{
		generateCaptcha();

		$category_taxes = $this->getTax();

		$dates = $this->getDates();

		// return $this->respond(session('filter')->nit->status);
    	return  view('landings/home', [
			'dates'				=> $dates,
			'category_taxes'	=> $category_taxes
		]);
	}

	public function findNit(){
		generateCaptcha();
		// $data = $this->request->getJson();
		$data = (object)$this->request->getPost();
		session('filter')->nit->number = $data->nit;
		session('filter')->anio = $data->anio;
		session('filter')->mes = $data->mes;
		$ultimoDigito = substr(session('filter')->nit->number, -1);
		session('filter')->last_dig = $ultimoDigito;

		// return $this->respond(session('filter'));

		if(session('filter')->nit->number != ''){
			$c_model = new Company();
			$company = $c_model->where(['nit' => session('filter')->nit->number])->first();
			session('filter')->nit->status = !empty($company);
		}


		$category_taxes = $this->getTax();

		$dates = $this->getDates();

		return view('landings/home', [
			'dates'				=> $dates,
			'category_taxes'	=> $category_taxes
		]);
	}

	public function register(){
		try {
			$data = $this->request->getJson();
			$validationCaptcha = ValidateReCaptcha($data->captcha);
			if(!$validationCaptcha)
				return $this->respond([
					'title'	=> 'Validación de usuario',
					'msg'	=> 'Error al validar el Captcha'
				], 500);
			$c_model = new Company();
			$company = $c_model->where(['nit' => $data->nit])->first();
			if(!empty($company))
				return $this->respond([
					'title' 	=> 'Empresa ya registrada',
					'msg'		=> "Ya existe una empresa registrada con el NIT {$data->nit}"
				], 500);
			$u_model = new User();
			$user = $u_model->where(['email' => $data->email])->first();
			if(!empty($user))
				return $this->respond([
					'title' 	=> 'Correo ya registrado',
					'msg'		=> "Ya existe un usuario registrado con el email {$data->email}"
				], 500);
			
			$data_user = [
				'name'		=> $data->name,
				'email'		=> $data->email,
				'username'	=> $data->email,
				'role_id'	=> 3,
				'status'	=> 'active'
			];
			if($u_model->save($data_user)){
				$user_id = $u_model->insertID();
				$p_model = new Password();
				$p_model->save([
					'user_id'   => $user_id,
					'password'  => password_hash($data->nit, PASSWORD_DEFAULT),
					'temporary'	=> "Si"
				]);

				$c_model->save([
					'user_id'	=> $user_id,
					'name'		=> $data->name_company,
					'nit'		=> $data->nit
				]);
				session('filter')->nit->status = true;
				$user = new User();
				$data = $user
					->select(['users.*', 'roles.name as role_name'])
					->join('roles', 'roles.id = users.role_id')
					->where(['users.id' => $user_id])->first();
				$data->password = $user->getPassword($data->id);
				$data->company = $user->getCompany($data->id);
				$session = session();
				$session->set('user-calendar', $data);
				$vista = view('emails/welcome', [
					'user'	=> (object) $data_user,
				]);
				$email = new EmailController();
				$response = $email->send('wabox324@gmail.com', 'wabox', $data->email, 'Bienvenido a '.isset(configInfo()['name_app']) ? configInfo()['name_app'] : 'IPLANET', $vista);
			}

			return $this->respond([
				'status' 	=> true,
				'msg'		=> "Usuario y empresa creado con exito."
			]);
		} catch (\Exception $e) {
            return $this->respond(['msg' => "Error en el servidor", "error" => $e->getMessage()], 500);
        }
	}

	public function login(){
		try {
			$data = $this->request->getJson();
			$validationCaptcha = ValidateReCaptcha($data->captcha);
			if(!$validationCaptcha)
				return $this->respond([
					'title'	=> 'Validación de usuario',
					'msg'	=> 'Error al validar el Captcha'
				], 500);
			$u_model = new User();
			$user = $u_model
				->select(['users.*', 'roles.name as role_name'])
				->join('roles', 'roles.id = users.role_id')
				->where('username', $data->email)
				->orWhere('email', $data->email)->first();
			if(empty($user))
				return $this->respond([
					'title'	=> 'Validación de usuario',
					'msg'	=> 'Usuario no registrado.'
				], 500);
			else if($user->status != 'active')
				return $this->respond([
					'title'	=> 'Validación de usuario',
					'msg'	=> 'El usuario no esta activo.'
				], 500);
			$user->password = $u_model->getPassword($user->id);
			if (!password_verify($data->password, $user->password->password)) {
				$p_model = new Password();
				$p_model->save([
					'id'        => $user->password->id,
					'attempts'  => (int) $user->password->attempts + 1
				]);
				return $this->respond([
					'title'     => 'Validación de usuario',
					'msg'   => "Las credenciales no concuerdan. Numeros de intentos restantes <b>".(4 - $user->password->attempts)."</b>"
				], 500);
			}

			$user->company = $u_model->getCompany($user->id);

			$session = session();
			$session->set('user-calendar', $user);
			return $this->respond([
				'title'	=> 'Validación de éxitosa',
				'msg'	=> "Redirigiendo página",
			]);
			
		} catch (\Exception $e) {
            return $this->respond(['msg' => "Error en el servidor", "error" => $e->getMessage()], 500);
        }
	}

	public function updated_company(){
		try {
			$data = $this->request->getJson();
			$c_model = new Company();
			$company = $c_model->find($data->company);
			if(empty($company))
				return $this->respond([
					'title'	=> 'Error al actualizar campos',
					'msg'	=> 'Empresa no encontrada.'
				], 500);
			if(!empty($data->email_2)){
				if(!filter_var($data->email_2, FILTER_VALIDATE_EMAIL))
					return $this->respond([
						'title'	=> 'Error al actualizar campos',
						'msg'	=> 'El correo 2 no es valido'
					], 500);
			}
			if(!empty($data->email_3)){
				if(!filter_var($data->email_3, FILTER_VALIDATE_EMAIL))
					return $this->respond([
						'title'	=> 'Error al actualizar campos',
						'msg'	=> 'El correo 3 no es valido'
					], 500);
			}

			$emails = $data->email_2;
			$emails .= !empty($data->email_3) ? " {$data->email_3}" : "";

			$data_save = [
				'id' 				=> $data->company,
				'name'				=> $data->name,
				'emails'			=> $emails,
				'nit'				=> $data->nit,
				'first_working_day'	=> $data->first_working_day,
				'three_days_due'	=> $data->three_days_due,
				'due_date'			=> $data->due_date,
			];
			if($c_model->save($data_save)){
				$c_model = new Company();
				$company = $c_model->find($data->company);
				session('user-calendar')->company = $company;
				return $this->respond([
					'title'	=> 'Campos actualizados',
					'msg'	=> 'Los campos se actualizaron con exito.',
					'data'	=> $data_save,
					'date_p'	=> $data
				],);
			}else{
				// new Exc
			}
		} catch (\Exception $e) {
            return $this->respond(['msg' => "Error en el servidor", "error" => $e->getMessage()], 500);
        }
	}

	public function send_emails(){
		$date = date('Y-m-d');
		$dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'];

		// if (date('d') == '29') {
			$c_model = new Company();
			$companies = $c_model
				->select([
					'companies.*',
					'users.name as user_name',
					'users.email as user_email',
				])
				->join('users', 'users.id = companies.user_id', 'left')
				->where(['first_working_day' => true])
				->findAll();
			foreach ($companies as $key => $company) {
				$last_digit_nit = substr($company->nit, -1);
				$tc_model = new TaxCalendar();
				$taxes = $tc_model
					->where(['last_digit_nit' => $last_digit_nit, 'YEAR(date)' => date('Y'), 'MONTH(date)' => date('m')])
					->join('calendary_taxes', 'calendary_taxes.id = upload_tax_calendar.calendary_tax_id', 'left')
				->findAll();
				$taxes = array_reduce($taxes, function ($result, $item) {
					$result[$item->date][] = $item;
					return $result;
				}, []);
				ksort($taxes);
				
				$vista = view('emails/notification', [
					'taxes'		=> $taxes,
					'company'	=> $company,
					'date'		=> $date,
					'dias'		=> $dias
				]);

				// $vista = view('emails/welcome', [
				// 	'company'	=> $company,
				// ]);

				// Mostrar el resultado
				// echo $vista; exit;
				// return view('emails/notification', [
				// 	'taxes'		=> $taxes,
				// 	'company'	=> $company,
				// 	'date'		=> $date,
				// 	'dias'		=> $dias
				// ]);

				$email = new EmailController();
				$response = $email->send('wabox324@gmail.com', 'wabox', $company->emails, 'Notificación pago de impuesots', $vista);
				if($response->status){
					var_dump([$taxes]);
				}else{
					return $this->respond([
						'status'    => '403',
						'title'     => 'Error al enviar la notificacion',
						'message'   => $response->message
					]);
				}
			}
			// return $this->respond($companies);
		// }
		die;
	}

	protected function getTax(){
		$ct_t_model = new CategoryTax();
		$category_taxes = $ct_t_model->findAll();
		foreach ($category_taxes as $key => $category) {
			$category->calendary = $ct_t_model->getCalendary($category->id);
			$category->calendary = array_values(array_filter($category->calendary, function ($calendary) use ($ct_t_model) {
				$datos = $ct_t_model->getCalendaryTax($calendary->id);
				$calendary->taxes = $datos;
				return !empty($calendary->taxes);
			}));
		}
		return $category_taxes;
	}

	protected function getDates(){
		$tc_model = new TaxCalendar();
		$dates = $tc_model
			->select([
				'DISTINCT YEAR(date) as anio',
				'LPAD(MONTH(date), 2, "0") AS mes'
			])
			->distinct('anio')
			->orderBy('anio', 'mes')->findAll();
		$dates = array_reduce($dates, function ($result, $item) {
			$year = $item->anio;
			$month = $item->mes;
			if (!isset($result[$year])) {
				$result[$year] = (object)[
					'anio' => $year,
					'meses' => []
				];
			}
			if (!in_array($month, $result[$year]->meses)) {
				$result[$year]->meses[] = $month;
			}
			return $result;
		}, []);
		$dates = array_values($dates);
		return $dates;
	}


	// Ver vista para las notificaciones
	public function notification($id_company){
		$c_model = new Company();
		$company = $c_model->find($id_company);
		if($company){
			$tc_model = new TaxCalendar();
			$ultimoDigito = substr($company->nit, -1);
			$taxes = $tc_model
				->select([
					'calendary_tax_id',
					'calendary_taxes.name as name_tax'
				])
				->join('calendary_taxes', 'calendary_taxes.id = upload_tax_calendar.calendary_tax_id')
				->where(['last_digit_nit' => $ultimoDigito])
				->groupBy('calendary_tax_id')
				->findAll();
			foreach ($taxes as $key => $tax) {
				$tax->notify = $tc_model->getNotification($tax->calendary_tax_id, $company->id);
			}
			$groupSize = ceil(count($taxes) / 3);

			// Dividir el array en grupos
			$groups_tax = array_chunk($taxes, $groupSize);
			// return $this->respond($taxes);
			// $taxes = $ct_model->findAll();
			return view('pages/company_notification', [
				'company' 	=> $company,
				'groups_tax'		=> $groups_tax
			]);
		} else throw PageNotFoundException::forPageNotFound();
	}

	public function created_notification(){
		try{
			$data = $this->request->getJson();
			$c_model = new Company();
			$company = $c_model->find($data->company);
			if(empty($company))
				return $this->respond([
					'title'	=> 'Empresa no valida',
					'msg'	=> 'No existe le empresa'
				], 500);
			switch ($data->name) {
				case 'email-notify-2':
					$emails_com = explode(" ", $company->emails);
					$emails = implode(" ", [$data->value, isset($emails_com[1]) ? $emails_com[1] : ""]) ;
					$data->emails = $emails;
					$c_model = new Company();
					$c_model->save(['id' => $company->id, 'emails' => $emails]);
					break;
				case 'email-notify-3':
					$emails_com = explode(" ", $company->emails);
					$emails = implode(" ", [!empty($emails_com[0]) ? $emails_com[0] : "", $data->value]) ;
					$data->emails = $emails;
					$c_model = new Company();
					$c_model->save(['id' => $company->id, 'emails' => $emails]);
					break;
				case 'checkbox':
					$cn_model = new CompanyNotification();
					if($data->checked)
						$cn_model->save(['company_id' => $company->id, 'calendary_tax_id' => $data->value]);
					else
						$cn_model->where(['company_id' => $company->id, 'calendary_tax_id' => $data->value])->delete();
					break;
				
				default:
					# code...
					break;
			}
			return $this->respond($data);
		} catch (\Exception $e) {
			return $this->respond(['msg' => "Error en el servidor", "error" => $e->getMessage()], 500);
		}
	}


	
	public function calendar()
	{
		$ct_model = new CalendaryTaxes();
		$tc_model = new TaxCalendar();
		$tax_calendar = $tc_model
			->select([
				'upload_tax_calendar.*',
				'calendary_taxes.name as name_tax',
				'calendary_taxes.color as color_tax'
			])
			->join("calendary_taxes", "upload_tax_calendar.calendary_tax_id = calendary_taxes.id", 'left')
			->like("upload_tax_calendar.date", "%".date('Y-m')."%")
		->findAll();
		$calendary_tax_ids = array_map(function($obj) {
			return $obj->calendary_tax_id;
		}, $tax_calendar);
		$calendary_taxes = $ct_model->whereIn("id", $calendary_tax_ids)->findAll();
		
		// return $this->respond([$tax_calendar, $calendary_taxes]);
    	return  view('landings/calendar', [
			'calendary_taxes' 	=> $calendary_taxes,
			'tax_calendar'		=> $tax_calendar
		]);
	}

	public function events(){
		try{
			$data = $this->request->getJson();
			$ct_model = new CalendaryTaxes();
			$tc_model = new TaxCalendar();
			$tax_calendar = $tc_model
				->select([
					'upload_tax_calendar.*',
					'calendary_taxes.name as name_tax',
					'calendary_taxes.color as color_tax'
				])
				->join("calendary_taxes", "upload_tax_calendar.calendary_tax_id = calendary_taxes.id", 'left')
				->where([
					'upload_tax_calendar.date >='	=> $data->start,
					'upload_tax_calendar.date <='	=> $data->end
				])
			->findAll();
			$calendary_tax_ids = array_map(function($obj) {
				return $obj->calendary_tax_id;
			}, $tax_calendar);
			$calendary_taxes = $ct_model->whereIn("id", $calendary_tax_ids)->findAll();
			return $this->respond([
				'calendary_taxes' 	=> $calendary_taxes,
				'tax_calendar'		=> $tax_calendar
			]);
		}catch(\Exception $e){
			return $this->respond(['status' => false, 'msg' => $e->getMessage()], 403);
		}
	}

}