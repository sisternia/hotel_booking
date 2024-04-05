<?php require_once("inc/links.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <!-- Footer -->
  <footer class="footer-section">
    <div class="container">
      <div class="footer-cta pt-5 pb-5">
        <div class="row">
          <div class="col-xl-4 col-md-4 mb-30">
            <div class="single-cta">
              <i class="bi bi-map"></i>
              <div class="cta-text">
                <h4>Địa chỉ</h4>
                <span><?php echo $contact_r['address'] ?></span>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-4 mb-30">
            <div class="single-cta">
              <i class="bi bi-telephone"></i>
              <div class="cta-text">
                <h4>Liên hệ cho chúng tôi</h4>
                <span><?php echo $contact_r['pn1'] ?> </span><br>
                <span><?php echo $contact_r['pn2'] ?> </span>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-4 mb-30">
            <div class="single-cta">
              <i class="bi bi-envelope"></i>
              <div class="cta-text">
                <h4>Email của chúng tôi</h4>
                <span><?php echo $contact_r['email'] ?> </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-content pt-5 pb-5">
        <div class="row">
          <div class="col-xl-4 col-lg-4 mb-50">
            <div class="footer-widget">
              <div class="footer-logo">
                <a href="index.php" style="text-decoration: none;">
                  <h2 class="fw-bold h-font text-center" style="color:white"><?php echo $settings_r['site_title'] ?></h2>
                </a>
              </div>
              <div class="footer-text">
                <p></p>
              </div>
              <div class="footer-social-icon text-center">
                <span>Theo dõi chúng tôi</span>
                <a href="<?php echo $contact_r['tw'] ?>" target="_blank" class="d-inline-block fs-5">
                  <i class="bi bi-twitter me-1"></i>
                </a>
                <a href="<?php echo $contact_r['fb'] ?>" target="_blank" class="d-inline-block fs-5">
                  <i class="bi bi-facebook me-1"></i>
                </a>
                <a href="<?php echo $contact_r['insta'] ?>" target="_blank" class="d-inline-block fs-5">
                  <i class="bi bi-instagram me-1"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
            <div class="footer-widget">
              <div class="footer-widget-heading">
                <h3>Liên kết</h3>
              </div>
              <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="about.php">Giới thiệu</a></li>
                <li><a href="rooms.php">Phòng</a></li>
                <li><a href="contact.php">Liên hệ</a></li>
                <li><a href="facilities.php">Tiện nghi</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
            <div class="footer-widget">
              <div class="footer-widget-heading">
                <h3>Chia sẻ</h3>
              </div>
              <div class="footer-text mb-25">
                <p><?php echo $settings_r['site_about'] ?></p>
              </div>
              <div class="subscribe-form">
                <form action="#">
                  <input type="text" placeholder="Email Address">
                  <button><i class="bi bi-arrow-right-square"></i></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  function alert(type, msg, position = 'body') {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
      <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
        <strong class="me-3">${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;

    if (position == 'body') {
      document.body.append(element);
      element.classList.add('custom-alert');
    } else {
      document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert, 3000);
  }

  function remAlert() {
    document.getElementsByClassName('alert')[0].remove();
  }

  function setActive() {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for (i = 0; i < a_tags.length; i++) {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if (document.location.href.indexOf(file_name) >= 0) {
        a_tags[i].classList.add('active');
      }

    }
  }

  let register_form = document.getElementById('register-form');

  register_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('name', register_form.elements['name'].value);
    data.append('email', register_form.elements['email'].value);
    data.append('phonenum', register_form.elements['phonenum'].value);
    data.append('address', register_form.elements['address'].value);
    data.append('pincode', register_form.elements['pincode'].value);
    data.append('dob', register_form.elements['dob'].value);
    data.append('pass', register_form.elements['pass'].value);
    data.append('cpass', register_form.elements['cpass'].value);
    data.append('profile', register_form.elements['profile'].files[0]);
    data.append('register', '');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);

    xhr.onload = function() {
      if (this.responseText == 'pass_mismatch') {
        alert('error', "Mật khẩu không khớp!");
      } else if (this.responseText == 'email_already') {
        alert('error', "Email đã được đăng ký!");
      } else if (this.responseText == 'phone_already') {
        alert('error', "Số điện thoại đã được đăng ký!");
      } else if (this.responseText == 'inv_img') {
        alert('error', "Chỉ cho phép hình ảnh JPG, WEBP & PNG!");
      } else if (this.responseText == 'upd_failed') {
        alert('error', "Tải lên hình ảnh không thành công!");
      } else if (this.responseText == 'mail_failed') {
        alert('error', "Không thể gửi email xác nhận! Máy chủ ngừng hoạt động!");
      } else if (this.responseText == 'ins_failed') {
        alert('error', "Đăng ký không thành công! Máy chủ ngừng hoạt động!");
      } else {
        alert('success', "Đăng ký thành công!");
        register_form.reset();
      }
    }

    xhr.send(data);
  });

  let login_form = document.getElementById('login-form');

  login_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('email_mob', login_form.elements['email_mob'].value);
    data.append('pass', login_form.elements['pass'].value);
    data.append('login', '');

    var myModal = document.getElementById('loginModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);

    xhr.onload = function() {
      if (this.responseText == 'inv_email_mob') {
        alert('error', "Email hoặc số di động không hợp lệ!");
      } else if (this.responseText == 'not_verified') {
        alert('error', "Email chưa được xác minh!");
      } else if (this.responseText == 'inactive') {
        alert('error', "Toàn khoản bị khoá! Vui lòng liên hệ Quản trị viên.");
      } else if (this.responseText == 'invalid_pass') {
        alert('error', "Mật khẩu không đúng!");
      } else {
        //Khởi tạo biến "fileurl" để lưu đường dẫn hiện tại của trang. Đường dẫn này được chia thành nhiều phần bằng dấu "/".
        //Hàm "split()" được sử dụng để chia đường dẫn thành các phần dựa trên dấu "/". Sau đó, ".pop()" được sử dụng để lấy ra phần tử cuối cùng của mảng,
        //Nghĩa là tên file của trang hiện tại. Sau đó, ".split('?')" được sử dụng để tách đường dẫn và các tham số của URL. ".shift()" được sử dụng để lấy phần tử đầu tiên của mảng
        let fileurl = window.location.href.split('/').pop().split('?').shift();
        if (fileurl == 'room_details.php') {
          window.location = window.location.href;
        } else {
          window.location = window.location.pathname;
        }
      }
    }

    xhr.send(data);
  });

  let forgot_form = document.getElementById('forgot-form');

  forgot_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('email', forgot_form.elements['email'].value);
    data.append('forgot_pass', '');

    var myModal = document.getElementById('forgotModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);

    xhr.onload = function() {
      if (this.responseText == 'inv_email') {
        alert('error', "Email không hợp lệ !");
      } else if (this.responseText == 'not_verified') {
        alert('error', "Email chưa được xác minh! Vui lòng liên hệ Quản trị viên");
      } else if (this.responseText == 'inactive') {
        alert('error', "Toàn khoản bị đình chỉ! Vui lòng liên hệ Quản trị viên.");
      } else if (this.responseText == 'mail_failed') {
        alert('error', "Không thể gửi email. Máy chủ ngừng hoạt động!");
      } else if (this.responseText == 'upd_failed') {
        alert('error', "Khôi phục tài khoản không thành công. Máy chủ ngừng hoạt động!");
      } else {
        alert('success', "Đặt lại liên kết được gửi đến email!");
        forgot_form.reset();
      }
    }

    xhr.send(data);
  });

  function checkLoginToBook(status, room_id) {
    if (status) {
      window.location.href = 'confirm_booking.php?id=' + room_id;
    } else {
      alert('error', 'Vui lòng đăng nhập để đặt phòng!');
    }
  }

  setActive();
</script>