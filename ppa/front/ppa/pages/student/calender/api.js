let data;

fetch(`localhost:3000/jobs/student?date=${year}-${month}`, {
  method: 'GET',
  headers: {
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${window.localStorage.getItem('token')}`
  }
})
  .then((response) => response.json())
  .then((response) => data = response);
