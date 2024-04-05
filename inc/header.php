<?php
require_once("inc/links.php");
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo $settings_r['site_title'] ?></a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
          <a class="nav-link me-2" href="index.php">Trang Chủ</a>
        </li>
        <li class="nav-item <?php echo ($current_page == 'rooms.php') ? 'active' : ''; ?>">
          <a class="nav-link me-2" href="rooms.php">Phòng</a>
        </li>
        <li class="nav-item <?php echo ($current_page == 'facilities.php') ? 'active' : ''; ?>">
          <a class="nav-link me-2" href="facilities.php">Tiện Nghi</a>
        </li>
        <li class="nav-item <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">
          <a class="nav-link me-2" href="contact.php">Liên Hệ</a>
        </li>
        <li class="nav-item <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="about.php">Giới Thiệu</a>
        </li>
      </ul>
      <div class="d-flex">
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
          $path = USERS_IMG_PATH;
          echo <<<data
              <div class="btn-group">
                <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                  <img src="$path$_SESSION[uPic]" style="width: 25px; height: 25px;" class="me-1 rounded-circle">
                  $_SESSION[uName]
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><a class="dropdown-item" href="profile.php">Thông Tin</a></li>
                  <li><a class="dropdown-item" href="bookings.php">Hóa đơn</a></li>
                  <li><a class="dropdown-item" href="logout.php">Đăng Xuất</a></li>
                </ul>
              </div>
            data;
        } else {
          echo <<<data
              <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                Đăng Nhập
              </button>
              <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                Đăng Ký
              </button>
            data;
        }
        ?>
      </div>
    </div>
  </div>
</nav>

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="display: flex; justify-content: center;">
    <div class="modal-content">
      <form id="login-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 me-2"></i> Khách Hàng Đăng Nhập
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email / SĐT</label>
            <input type="text" name="email_mob" required class="form-control shadow-none">
          </div>
          <div class="mb-4">
            <label class="form-label">Mật Khẩu</label>
            <div class="input-group mb-3">
              <input type="password" name="pass" id="password" class="form-control shadow-none" required />
              <button class="btn btn-outline-secondary" type="button" aria-hidden="true" id="eye" onclick="toggle()"><i class="bi bi-eye"></i></button>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <button type="submit" class="btn btn-dark shadow-none">Đăng Nhập</button>
            <button type="button" class="btn text-secondary text-decoration-none shadow-none p-0" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">
              Quên mật khẩu?
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" style="display: flex; justify-content: center;">
    <div class="modal-content">
      <form id="register-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-lines-fill fs-3 me-2"></i> Khách Hàng Đăng Ký
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Họ và Tên</label>
                <input name="name" type="text" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Số Điện Thoại</label>
                <input name="phonenum" type="number" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Ảnh</label>
                <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Địa chỉ</label>
                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Mã Tỉnh</label>
                <input name="pincode" type="number" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Ngày Sinh</label>
                <input name="dob" type="date" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Mật Khẩu</label>
                <div class="input-group mb-3">
                  <input type="password" name="pass" id="password1" class="form-control shadow-none" required />
                  <button class="btn btn-outline-secondary" type="button" aria-hidden="true" id="eye1" onclick="toggle1()"><i class="bi bi-eye"></i></button>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Nhập Lại Mật Khẩu</label>
                <div class="input-group mb-3">
                  <input type="password" name="cpass" id="password2" class="form-control shadow-none" required />
                  <button class="btn btn-outline-secondary" type="button" aria-hidden="true" id="eye2" onclick="toggle2()"><i class="bi bi-eye"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center my-1">
            <button type="submit" class="btn btn-dark shadow-none">ĐĂNG KÝ</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="display: flex; justify-content: center;">
    <div class="modal-content">
      <form id="forgot-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 me-2"></i> Quên mật khẩu
          </h5>
        </div>
        <div class="modal-body">
          <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
            Lưu ý: Một liên kết sẽ được gửi đến email của bạn để đặt lại mật khẩu của bạn!
          </span>
          <div class="mb-4">
            <label class="form-label">Email</label>
            <input type="email" name="email" required class="form-control shadow-none">
          </div>
          <div class="mb-2 text-end">
            <button type="button" class="btn shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
              HUỶ
            </button>
            <button type="submit" class="btn btn-dark shadow-none">GỬI LINK</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  var state = false;

  function toggle() {
    if (state) {
      document.getElementById("password").setAttribute("type", "password");
      document.getElementById("eye").style.color = '#7a797e';
      state = false;
    } else {
      document.getElementById("password").setAttribute("type", "text");
      document.getElementById("eye").style.color = '#5887ef';
      state = true;
    }
  }

  var state1 = false;

  function toggle1() {
    if (state1) {
      document.getElementById("password1").setAttribute("type", "password");
      document.getElementById("eye1").style.color = '#7a797e';
      state1 = false;
    } else {
      document.getElementById("password1").setAttribute("type", "text");
      document.getElementById("eye1").style.color = '#5887ef';
      state1 = true;
    }
  }

  var state2 = false;

  function toggle2() {
    if (state2) {
      document.getElementById("password2").setAttribute("type", "password");
      document.getElementById("eye2").style.color = '#7a797e';
      state2 = false;
    } else {
      document.getElementById("password2").setAttribute("type", "text");
      document.getElementById("eye2").style.color = '#5887ef';
      state2 = true;
    }
  }
</script>