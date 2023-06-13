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
  if(month > 0) {
    month--;
    clearCalender();
    createCalender(year, month);
  }  
});

allThOfThead[2].addEventListener('click', () => {
  if(month < 11) {
    month++;
    clearCalender();
    createCalender(year, month);
  }
});

function viewTasks(tasks) {
  const ul = document.querySelector('#viewTasks');
  ul.innerHTML = '';
  tasks.forEach((task) => {
    const li = document.createElement('li');
    li.textContent = `${task.title} - ${task.matter}`;
    li.classList.add('viewTask');
    li.setAttribute('role', 'button');
    li.addEventListener('click', function onClick() {
      const title = document.querySelector('#titleTask');
      title.textContent = task.title;
      const date = document.querySelector('#dateViewTask');
      date.textContent = `${new Date(task.updatedAt).toLocaleString()} - ${new Date(task.deadline).toLocaleString()}`;
      const note = document.querySelector('#noteTask');
      note.textContent = task.note;
      const description = document.querySelector('#descriptionViewTask');
      description.textContent = task.description;
      showModal('modalViewTask', 'closeModalViewTask');
    });
    ul.appendChild(li);
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
    const li = document.createElement('li');
    li.textContent = `${time.startTime} - ${time.endTime}`;
    li.classList.add('viewVacantClass');
    if(time.captured) li.style.backgroundColor = 'var(--color-green)';
    li.setAttribute('role', 'button');
    li.addEventListener('click', function onClick() {
      if(!li.children.length) {
        const div = document.createElement('div');

        const div2 = document.createElement('div');
        const vacantClass = document.createElement('p');
        vacantClass.textContent = `${time.infos.matter} - ${time.infos.teacher}`;
        div2.classList.add('vacantClass');

        const span = document.createElement('span');
        div2.prepend(span);
        div2.appendChild(vacantClass);

        div.appendChild(div2);

        if(time.captured) {
          const div3 = document.createElement('div');
          const captured = document.createElement('p');
          captured.textContent = `${time.infosCaptured.matter} - ${time.infosCaptured.teacher}`;
          div3.classList.add('capturedVacantClass');
          const spanCaptured = document.createElement('span');
          div3.prepend(spanCaptured);
          div3.appendChild(captured);
          div.appendChild(div3);
        }
        li.appendChild(div);
      } else {
        const div = this.children[0];
        this.removeChild(div);
      }
      this.classList.toggle('infosVacantClass');
    });
    ul.appendChild(li);
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

(() => {
  const days = document.querySelectorAll('#bodyTable > tr > td');
  const date = new Date();
  const today = date.getDate();
  days.forEach((day) => {
    if(day.innerHTML == today || day.innerHTML == `0${today}`)
      day.click();
  });
})();
