/**
 * App Calendar Events
 */

'use strict';

// function createEvent(id, title, date, allDay = false, calendar = '', color ="red") {
//   let [year, month, day] = date.split("-").map(Number);
//   let startDate = new Date(year, month - 1, day); // Meses en JavaScript van de 0 a 11
//   startDate.setHours(0, 0, 0, 0); // Inicio del día

//   // Crear la fecha de finalización del día
//   let endDate = new Date(year, month - 1, day); // Misma fecha base
//   endDate.setHours(23, 59, 59, 999); // Fin del día

//   return {
//     id,
//     url: '',
//     title,
//     start: startDate,
//     end: endDate,
//     allDay,
//     extendedProps: { calendar, color },
//   };
// }

window.events = [
  ...tax_events().map((t) =>
    createEvent(t.id, t.name_tax, t.date, true, t.calendary_tax_id, t.color_tax)
  )
];