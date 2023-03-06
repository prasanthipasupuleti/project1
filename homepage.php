<html>
<head>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/f1f497abb8.js" crossorigin="anonymous"></script>
  <script src="vue.min.js" ></script>
  <script src="axios.min.js" ></script>
  <style>
    .container .btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: forestgreen;
  color: white;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}
</style>
</head>
<body>
  <div id="app">
    <div class="bg-dark-subtle d-flex justify-content-center">
      <h1 class="text-success pe-2" style="font-size: 60px;">Blood Bank</h1>
      <img src="https://cdn.pixabay.com/photo/2013/07/13/09/48/blood-156063__340.png" width="60px" class="p-2">
    </div>
    <div class="bg-danger-subtle h-100" style="position: fixed; width: 100%;">
      <div class="d-flex flex-column justify-content-center align-items-center pt-5">
        <div class="fs-1 fw-bold font-sans-serif" style="margin-top: -10px;">Welcome to Blood Bank!</div>
        <div class="fs-5 fw-bold font-sans-serif">Donate 'Blood' Save Life.</div>
        <div class="container">
        <img src="https://t3.ftcdn.net/jpg/00/67/70/40/240_F_67704008_fxdmJ8wDOqDYts9P3tzdbxqZf8NfWT21.jpg" width="600px" height="300px" style="margin-left: 260px;">
        <button class="btn me-2" style="margin-top: -45px" type="button">Login</button>
          <button class="btn me-2" style="margin-top: 10px" type="button">Register</button>
        </div>
      </div>
      </div>
    </div>
</div>
</body>
</html>