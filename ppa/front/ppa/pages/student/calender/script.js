const allThOfThead = document.querySelectorAll('.calender > table > thead > tr > th');
const today = new Date();
let [year, month] = [today.getFullYear(), today.getMonth()];

function numberOfDaysInTheMonth(year, month) {
  const date = new Date(year, month + 1, 0);
  return date.getDate();
}

function getNameMonth(month) {
  const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
  return months[month];
}

function getInitialDay(year, month) {
  const date = new Date(year, month);
  const day = date.getDay();
  return day;
}

function clearCalender() {
  const tableBody = document.querySelector('.calender > table > tbody');
  tableBody.innerHTML = '';
}

allThOfThead[0].addEventListener('click', () => {
  if(month == 0){
    month = 11;
    clearCalender();
    createCalender(year, month);
  }
  else if(month > 0) {
    month--;
    clearCalender();
    createCalender(year, month);
  }  
});

allThOfThead[2].addEventListener('click', () => {
  if(month == 11){
    month = 0;
    clearCalender();
    createCalender(year, month);
  }
  else if(month < 11) {
    month++;
    clearCalender();
    createCalender(year, month);
  }
});

function viewTasks(tasks) {
  const ul = document.querySelector('#viewTasks');
  ul.innerHTML = '';
  tasks.forEach((task) => {
    const details = document.createElement('details');
    details.classList.add('viewTask');
    const summary = document.createElement('summary');
    summary.textContent = `${task.title} - ${task.matter}`;
    const divcontent = document.createElement("div");
    divcontent.classList.add("TaskContent");
    const p1 = document.createElement('p');
    p1.textContent = "Nota: " + task.note;
    const br1 = document.createElement('br');
    p1.appendChild(br1);
    const p2 = document.createElement('p');
    p2.textContent = "Descrição: " + task.description;
    const br2 = document.createElement('br');
    p2.appendChild(br2);
    const p3 = document.createElement('p');
    p3.classList.add("DateTask");
    p3.textContent = `Criado:  ${new Date(task.createdAt).toLocaleString()}`;
    
    divcontent.appendChild(p1);
    divcontent.appendChild(p2);
    divcontent.appendChild(p3);

    details.appendChild(summary);
    details.appendChild(divcontent);
    ul.appendChild(details);
  });
}

function none(id, text) {
  const ul = document.querySelector(`#${id}`);
  ul.innerHTML = '';
  const li = document.createElement('li');
  li.textContent = text;
  li.classList.add('none');
  ul.appendChild(li);
}

function viewVacantClasses(times) {
  const ul = document.querySelector('#viewVacantClasses');
  ul.innerHTML = '';
  times.forEach((time) => {
    const details = document.createElement('details');
    details.classList.add("viewVacantClass");
    const summary = document.createElement('summary');
    summary.style.backgroundColor = 'var(--color-blue)';
    summary.textContent = `${time.startTime} - ${time.endTime}`;
    

    const divcontent = document.createElement("div");
    divcontent.classList.add("TimeContent");
    const divvacantclass = document.createElement("div");
    divvacantclass.classList.add('vacantClass');
    const pvacantclass = document.createElement('p');
    pvacantclass.textContent = `${time.infos.matter} - ${time.infos.teacher}`;
    const spanvacantclass = document.createElement('span');
    divvacantclass.appendChild(spanvacantclass);
    divvacantclass.appendChild(pvacantclass);

    divcontent.appendChild(divvacantclass);


        if(time.captured) {
          summary.style.backgroundColor = 'var(--color-green)';
          const divcaptured = document.createElement('div');
          divcaptured.classList.add('capturedVacantClass');
          const captured = document.createElement('p');
          captured.textContent = `${time.infosCaptured.matter} - ${time.infosCaptured.teacher}`;
          const spanCaptured = document.createElement('span');
          divcaptured.prepend(spanCaptured);
          divcaptured.appendChild(captured);
          divcontent.appendChild(divcaptured);
        }

    details.appendChild(summary);  
    details.appendChild(divcontent);
    
    ul.appendChild(details);
  });
}

const createCalender = (year, month) => {
  const day = getInitialDay(year, month);
  let initialDay = 1;
  const totalDays = numberOfDaysInTheMonth(year, month);
  allThOfThead[1].innerHTML = getNameMonth(month);
  const bodyTable = document.querySelector('.calender > table > tbody');
  let countLines = totalDays === 31 && day > 4 ? 6 : 5;
  for(let l = 0;l < countLines;l++) {
    const tr = document.createElement('tr');
    for(let c = 0;c < 7;c++) {
      const td = document.createElement('td');
      if((l === 0 && c >= day && initialDay <= totalDays) || (l !== 0 && initialDay <= totalDays)) {
        td.innerHTML = initialDay;
        td.setAttribute('role', 'button');
        if(c >= 1 && c <= 5 && td.innerHTML) {
          td.classList.add('backGreen');
        }

        data.forEach((result) => {
          const isDay = result.date.split('T')[0] == `${year}-${month + 1}-${initialDay < 10 ? '0' + initialDay : initialDay}`;
          if(isDay) {
            if(result?.tasks?.length === 1) {
              td.classList.add('backYellow');
            } else if(result?.tasks?.length === 2) {
              td.classList.add('backOrange');
            } else if(result?.tasks?.length >= 3) {
              td.classList.add('backRed');
            }

            if(result?.vacantClasses?.length) {
              td.classList.add('nameBlue'); 

              result.vacantClasses.forEach((time) => {
                if(time.captured) td.classList.add('captured');
              });
            }
          }

          td.addEventListener('click', function onClick() {
            const allDays = document.querySelectorAll('#bodyTable > tr > td');
            allDays.forEach((day) => {
              if(day.innerHTML !== '') {
                if(this !== day && !this.classList.contains('selected'))
                  this.classList.add('selected');
                else if(this !== day && day.classList.contains('selected'))
                  day.classList.remove('selected');
              }
            });

            if(result?.tasks?.length && isDay) viewTasks(result.tasks);
            else if(!this.classList.contains('backYellow') && 
                    !this.classList.contains('backOrange') && 
                    !this.classList.contains('backRed')) 
              none('viewTasks', 'Nenhum lembrete');

            if(result?.vacantClasses?.length && isDay) viewVacantClasses(result.vacantClasses);
            else if(!this.classList.contains('nameBlue')) none('viewVacantClasses', 'Nenhuma aula vaga');
          });
        });
        initialDay++;
      }
      tr.appendChild(td);
    }
    bodyTable.appendChild(tr);
  }
};

createCalender(year, month);

(() => {
  const days = document.querySelectorAll('#bodyTable > tr > td');
  const date = new Date();
  const today = date.getDate();
  days.forEach((day) => {
    if(day.innerHTML == today || day.innerHTML == `0${today}`)
      day.click();
  });
})();


