

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edvge">
    <title>USeP | LMS</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css/admin_dashboard.css">
</head>

<body>
    <nav class="navbar navbar-light bg-light header" id="navbar">
        <div class="container-fluid">

            <div class="head-text">
                <div> <img src="../icons/usep-logo.png" alt="" class="custom_img"></div>
                <div class="usep-text">
                    <p style="font-size: 14px; font-weight: bold">University of Southeastern Philippines Tagum - Mabini Campus</p>
                    <p style="font-size: 12px; font-weight: 600; margin-top: -20px">Apokon RD, Tagum City Davao Del Norte 8100</p>
                </div>
            </div>
            <div class="right-side">
                <div class="right-side-text">
                    <p style="font-size: 14px; font-weight: bold;">LIBRARY MANAGEMENT SYSTEM</p>
                    <p style="font-size: 12px; font-weight: 600; margin-top: -20px">E - System Environment</p>
                </div>
            </div>
        </div>
    </nav>
   

     <!-- offcanvas -->
  <div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="sidebar" style="width: 220px;">
    <div class="offcanvas-body p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav">
          <li>
            <!-- <div class="text-muted usep fw-bold text-uppercase px-3 py-2">
              University of Southeastern Philippines
            </div> -->
          </li>
          <li>
            <a href="#" class="nav-link px-3 text-white  mt-5">
              <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Dashboard </span>
            </a>
          </li>


          </li>
          <li>
            <a class="nav-link px-3 sidebar-link text-white" data-bs-toggle="collapse" href="#layouts">
              <span class="me-2"><i class="bi bi-card-checklist"></i></span>
              <span>Inventory</span>
              <span class="ms-auto">
                <span class="right-icon">
                  <i class="bi bi-chevron-down"></i>
                </span>
              </span>
            </a>
            <div class="collapse" id="layouts">
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="#" class="nav-link px-3 text-white">
                    <span class="me-2"><i class="bi bi-journal-plus"></i></span>
                    <span>Add Book</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a href="#" class="nav-link px-3 text-white">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Students</span>
            </a>
          </li>

          </li>
          <li>
            <a href="#" class="nav-link px-3 text-white">
              <span class="me-2"><i class="bi bi-flag"></i></span>
              <span>Reports</span>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link px-3 text-white">
              <span class="me-2"><i class="bi bi-card-checklist"></i></span>
              <span>Logs</span>
            </a>
          </li>
        </ul>
        </nav>
    </div>
  </div>





  <!-- offcanvas -->
  <main class="mt-5 pt-3 ">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 mt-2 ">
          <h4>Dashboard</h4>
        </div>
      </div>
      <div class="row align-content-center justify-content-center">
        <div class="col-md-2 mb-3 ">
          <div class="card bg-warning text-white h-100 ">
            <div class="box card-footer d-flex justify-content-center fw-bolder">
              Books Borrowed
            </div>
            <div class="box card-body align-content-center">
              <i class="book card-body bi bi-journal-album m-3 "></i>
              <div class="card-body NumBook ">
                450
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-2 mb-3 ">
          <div class="card bg-light text-white h-100 ">
            <div class="box2 card-footer d-flex justify-content-center fw-bolder text-dark">
              New Members
            </div>
            <div class="box2 card-body align-content-center text-dark">
              <i class="book card-body bi bi-person-check m-3 "></i>
              <div class="card-body NumBook ">
                302
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-2 mb-3 ">
          <div class="card bg-light text-white h-100 ">
            <div class="box card-footer d-flex justify-content-center fw-bolder ">
              Daily Visitors
            </div>
            <div class="box card-body align-content-center ">
              <i class="book card-body bi bi-person-lines-fill m-3 "></i>
              <div class="card-body NumBook ">
                768
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 mb-3 ">
          <div class="card bg-light text-white h-100 ">
            <div class="box2 card-footer d-flex justify-content-center fw-bolder text-dark">
              Monthly Visitors
            </div>
            <div class="box2 card-body align-content-center text-dark">
              <i class="book card-body bi bi-calendar-check m-3 "></i>
              <div class="card-body NumBook ">
                302
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-2 mb-3 ">
          <div class="card bg-light text-white h-100 ">
            <div class="box card-footer d-flex justify-content-center fw-bolder ">
              Total Books
            </div>
            <div class="box card-body align-content-center ">
              <i class="book card-body bi bi-bookshelf m-4 "></i>
              <div class="card-body NumBook ">
                1,000
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-6 mb-3 mt-2">
            <div class="card shadow">
              <div class="card-body py-5 text-dark">
                <h4>Users Rating</h4>
                <sub>Status Records of LMS</sub>
                <p>This is the overview content.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-3 mt-2">
            <div class="card shadow">
              <div class="card-body py-5 text-dark">
                <h4>Users Rating</h4>
                <sub>Status Records of LMS</sub>
                <p>This is the overview content.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3 mt-2">
            <div class="card shadow">
              <div class="card-body py-5 text-dark">
                <h4>Users Rating</h4>
                <sub>Status Records of LMS</sub>
                <p>This is the overview content.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-3 mt-2">
            <div class="card shadow">
              <div class="card-body py-5 text-dark">
                <h4>Users Rating</h4>
                <sub>Status Records of LMS</sub>
                <p>This is the overview content.</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>
   

</body>

</html>