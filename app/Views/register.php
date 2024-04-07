<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>

<body>

  <section class="bg-light py-3 py-md-5">
    <div class="container">

      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
          <div class="card border border-light-subtle rounded-3 shadow-sm">
            <div class="card-body p-3 p-md-4 p-xl-5">
              <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Sign in to your account</h2>
              <form method="post" id="registerForm" onsubmit="return userLogin()">
                <div class="row gy-2 overflow-hidden">
                  <div class="alert alert-success invisible" style="margin-block-start: 15px;" id="register_form_message"></div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                      <label for="email" class="form-label">Email</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="username" id="username" value="" placeholder="username" required>
                      <label for="username" class="form-label">Username</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                      <label for="password" class="form-label">Password</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <select name="role" id="role" class="form-select" aria-label="Default select example">
                        <option value="2">teknisyen</option>
                        <option value="3">tekniker</option>
                        <option value="4">mühendis</option>
                        <option value="5">yüksek mühendis</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="d-grid my-3">
                      <button id="registerButton" class="btn btn-primary btn-lg" type="submit">Signup</button>
                    </div>
                  </div>
                  <div class="col-12">
                    <p class="m-0 text-secondary text-center">already have an account ? <a href="<?= base_url(); ?>login" class="link-primary text-decoration-none">login</a></p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script>
    function showRegisterMessage(messageType, messageText) {
      $('#register_form_message').text(messageText).removeAttr('class').addClass('alert alert-' + messageType);
    }

    $("#registerButton").on("click", function(event) {
      event.preventDefault();
      userRegister();
    })

    function userRegister() {
      $.ajax({
        url: '/register',
        type: 'post',
        dataType: 'json',
        data: {
          email: $("#email").val(),
          username: $("#username").val(),
          password: $("#password").val(),
          role:$("#role").val()
        },
        success: function(data) {
          if (data.success) {
            showRegisterMessage('success', data.message);
            window.location.href = '/';
          } else {
            showRegisterMessage('danger', data.message);
          }
        }
      });

      return false;

    }
  </script>
</body>

</html>