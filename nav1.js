
fetch('nav.php')
  .then(response => response.text())
  .then(data => {
    document.getElementById('navbar-container').innerHTML = data;
  });
