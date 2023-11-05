<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USeP | LMS</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/admin_inventory.css">
</head>
<body style="">
<div>
    <nav class="navbar navbar-light bg-light header">
        <div class="container-fluid">

            <div class="head-text">
                <div> <img src="../icons/usep-logo.png" alt="" class="custom_img" id="usep-logo"></div>
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

    <div class="main-content d-flex" >
        <div class="col col-md-2 side_bar">
            <div class="profile_section">
                <div>
                    <img style="width: 60px; border-radius: 60px;" src="../img/me_sample_profile.jpg" alt="">
                </div>
                <div style="display: block; text-align: center; color: white; height: 20px;">
                    <ul style="margin-right: 36px;">
                        <li style="font-size: 12px; color: #0cb90c; font-weight: 600">Active</li>
                    </ul>
                </div>
            </div>
            <div>
                <ul class="menu_icon">
                    <li><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="dashboard.php">Dashboard</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="student.php">Student</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                    <li class="active"><img class="custom_menu_icon" src="../icons/admin_inventory_menu.png" alt=""><span><a href="inventory.php">Inventory</a></span></li>

                </ul>
            </div>

        </div>
        <div class="col" style=" width: 100%; height: 100vh; ">
            <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                <div style="width: 90%">
                    <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | INVENTORY</p>
                </div>
                <div class=" d-flex justify-content-end align-items-center" style="height: 50px; width: 10%; margin-right: 20px ">
                    <div class="dropdown" style=" margin-right: 0px; position: absolute">
                        <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../img/me_sample_profile.jpg" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="manage_account.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                        <li><a class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../operations/logout.php"><img src="../icons/plug.png" alt="" class="custom_icon"><span>Logout</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div style="display: flex; justify-content: center; ">
                <div style="width: 95%; height: 40px;border-radius: 5px; display: flex; align-items: center; ">
                   <div class="col col-md-10" style="display: flex; align-items: center;" >
                       <input id="select_all_book" type="checkbox">
                       <label style="font-size: 12px; font-weight: 600; margin-left: 5px" for="select_all_book">Select All</label>

                       <div class="search_by" style="margin-left: 40px;">
                           <select name="" id="select-book-category">
                               <option value="option">Search Categories</option>
                               <option value="option">Environment and Forestry</option>
                               <option value="option">Agriculture and Agriculture Engineering</option>
                               <option value="option">Usepiana</option>
                               <option value="option">General Information</option>
                               <option value="option">Filipiñiana </option>
                               <option value="option">Educational</option>
                               <option value="option"> Video Tapes</option>
                               <option value="option"> Special Education</option>
                               <option value="option">Others</option>
                           </select>
                       </div>
                       <div class="input_search-wrapper" style="margin-left: 20px;">
                           <input type="search" class="search-input" placeholder="Search Book">
                       </div>
                   </div>
                    <div class="col col-md-2" style="display: flex; align-items: center; justify-content: flex-end;" >
                        <button style="width: 30px; border: none; background: transparent;"><img style="width: 25px; margin-right: 20px;" src="../icons/download_icon.png" alt=""></button>
                        <button style="font-size: 12px; width: 150px; height: 30px; border-radius: 5px; background-color: rgb(128,0,0); color: white; border: none">ADD BOOK</button>
                    </div>
                </div>
            </div>
            <div style="display: flex; justify-content: center;">
                <div style="width: 95%; min-height: 100vh; margin-top: 10px; ">
                    <div class="col col-md-12" style="background: rgb(246,246,247); height: 38vh; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2); display: flex; align-items: center; padding: 15px 5px 15px 15px; margin: 20px 0px 0px 0px;">
                        <div class="card" style="width: 25rem; height: 250px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 0px 10px 0px 0px;">
                            <div class="card-body">
                                <h6 class="card-title"><input type="checkbox"></h6>
                                <div style="width: 100%; height: 21vh; display: flex;">
                                    <div style=" height: 21vh; width: 138px; overflow: hidden ">
                                        <img style="width: 97px" src="../book_img/1984.jpg" alt="">
                                    </div>
                                    <div style="width: 100%; height: 21vh; margin-left: 15px; ">
                                        <h6 style="font-size: 12px; font-weight: 700; font-style: italic">1984</h6>
                                        <div class="book_information_inventory" style="display: flex;">
                                            <div>
                                                <p>George Orwell</p>
                                                <p>Status: <span style="color: green; font-weight: 700">AVAILABLE</span></p>
                                            </div>
                                            <div style="margin-left: 20px">
                                                <p>Fiction</p>
                                                <p>Shelf: <span style="color: #711717; font-weight: 700">CN1023</span></p>
                                            </div>
                                        </div>
                                        <div  style="line-height: 15px; font-size: 10px; padding: 0px 0px 0px 5px;">
                                            <p>Description:</p>
                                            <p style="margin-top: -15px;">The story begins when a band of seven “uncool” 11-year-olds, led by Bill Denbrough, discovers and battles an evil, shape-changing monster that the children call “It.” It ....</p>
                                        </div>
                                    </div>

                                </div>
                                <div style="width: 96px; height: 18px; display: flex; justify-content: center; padding: 2px 0px 0px 0px;">
                                    <p style="font-size: 10px; font-weight: 600">Copies Left: 3</p>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    <button style="border: none; background: transparent; margin-right: 15px;"><img style="width: 17px" src="../icons/edit_profile_icon.png" alt=""></button>
                                    <button style="border: none; background: transparent"><img style="width: 20px" src="../icons/delete_book_inventory.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="width: 25rem; height: 250px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 0px 10px 0px 0px;">
                            <div class="card-body">
                                <h6 class="card-title"><input type="checkbox"></h6>
                                <div style="width: 100%; height: 21vh; display: flex;">
                                    <div style=" height: 21vh; width: 138px; overflow: hidden ">
                                        <img style="width: 97px" src="../book_img/1984.jpg" alt="">
                                    </div>
                                    <div style="width: 100%; height: 21vh; margin-left: 15px; ">
                                        <h6 style="font-size: 12px; font-weight: 700; font-style: italic">1984</h6>
                                        <div class="book_information_inventory" style="display: flex;">
                                            <div>
                                                <p>George Orwell</p>
                                                <p>Status: <span style="color: green; font-weight: 700">AVAILABLE</span></p>
                                            </div>
                                            <div style="margin-left: 20px">
                                                <p>Fiction</p>
                                                <p>Shelf: <span style="color: #711717; font-weight: 700">CN1023</span></p>
                                            </div>
                                        </div>
                                        <div  style="line-height: 15px; font-size: 10px; padding: 0px 0px 0px 5px;">
                                            <p>Description:</p>
                                            <p style="margin-top: -15px;">The story begins when a band of seven “uncool” 11-year-olds, led by Bill Denbrough, discovers and battles an evil, shape-changing monster that the children call “It.” It ....</p>
                                        </div>
                                    </div>

                                </div>
                                <div style="width: 96px; height: 18px; display: flex; justify-content: center; padding: 2px 0px 0px 0px;">
                                    <p style="font-size: 10px; font-weight: 600">Copies Left: 3</p>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    <button style="border: none; background: transparent; margin-right: 15px;"><img style="width: 17px" src="../icons/edit_profile_icon.png" alt=""></button>
                                    <button style="border: none; background: transparent"><img style="width: 20px" src="../icons/delete_book_inventory.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="width: 25rem; height: 250px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 0px 10px 0px 0px;">
                            <div class="card-body">
                                <h6 class="card-title"><input type="checkbox"></h6>
                                <div style="width: 100%; height: 21vh; display: flex;">
                                    <div style=" height: 21vh; width: 138px; overflow: hidden ">
                                        <img style="width: 97px" src="../book_img/book1.jpg" alt="">
                                    </div>
                                    <div style="width: 100%; height: 21vh; margin-left: 15px; ">
                                        <h6 style="font-size: 12px; font-weight: 700; font-style: italic">1984</h6>
                                        <div class="book_information_inventory" style="display: flex;">
                                            <div>
                                                <p>George Orwell</p>
                                                <p>Status: <span style="color: green; font-weight: 700">AVAILABLE</span></p>
                                            </div>
                                            <div style="margin-left: 20px">
                                                <p>Fiction</p>
                                                <p>Shelf: <span style="color: #711717; font-weight: 700">CN1023</span></p>
                                            </div>
                                        </div>
                                        <div  style="line-height: 15px; font-size: 10px; padding: 0px 0px 0px 5px;">
                                            <p>Description:</p>
                                            <p style="margin-top: -15px;">The story begins when a band of seven “uncool” 11-year-olds, led by Bill Denbrough, discovers and battles an evil, shape-changing monster that the children call “It.” It ....</p>
                                        </div>
                                    </div>

                                </div>
                                <div style="width: 96px; height: 18px; display: flex; justify-content: center; padding: 2px 0px 0px 0px;">
                                    <p style="font-size: 10px; font-weight: 600">Copies Left: 3</p>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    <button style="border: none; background: transparent; margin-right: 15px;"><img style="width: 17px" src="../icons/edit_profile_icon.png" alt=""></button>
                                    <button style="border: none; background: transparent"><img style="width: 20px" src="../icons/delete_book_inventory.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-12" style="background: rgb(246,246,247); height: 38vh; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2); display: flex; align-items: center; padding: 15px 5px 15px 15px; margin: 20px 0px 0px 0px;">
                        <div class="card" style="width: 25rem; height: 250px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 0px 10px 0px 0px;">
                            <div class="card-body">
                                <h6 class="card-title"><input type="checkbox"></h6>
                                <div style="width: 100%; height: 21vh; display: flex;">
                                    <div style=" height: 21vh; width: 138px; overflow: hidden ">
                                        <img style="width: 97px" src="../book_img/book2.jpg" alt="">
                                    </div>
                                    <div style="width: 100%; height: 21vh; margin-left: 15px; ">
                                        <h6 style="font-size: 12px; font-weight: 700; font-style: italic">1984</h6>
                                        <div class="book_information_inventory" style="display: flex;">
                                            <div>
                                                <p>George Orwell</p>
                                                <p>Status: <span style="color: green; font-weight: 700">AVAILABLE</span></p>
                                            </div>
                                            <div style="margin-left: 20px">
                                                <p>Fiction</p>
                                                <p>Shelf: <span style="color: #711717; font-weight: 700">CN1023</span></p>
                                            </div>
                                        </div>
                                        <div  style="line-height: 15px; font-size: 10px; padding: 0px 0px 0px 5px;">
                                            <p>Description:</p>
                                            <p style="margin-top: -15px;">The story begins when a band of seven “uncool” 11-year-olds, led by Bill Denbrough, discovers and battles an evil, shape-changing monster that the children call “It.” It ....</p>
                                        </div>
                                    </div>

                                </div>
                                <div style="width: 96px; height: 18px; display: flex; justify-content: center; padding: 2px 0px 0px 0px;">
                                    <p style="font-size: 10px; font-weight: 600">Copies Left: 3</p>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    <button style="border: none; background: transparent; margin-right: 15px;"><img style="width: 17px" src="../icons/edit_profile_icon.png" alt=""></button>
                                    <button style="border: none; background: transparent"><img style="width: 20px" src="../icons/delete_book_inventory.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="width: 25rem; height: 250px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 0px 10px 0px 0px;">
                            <div class="card-body">
                                <h6 class="card-title"><input type="checkbox"></h6>
                                <div style="width: 100%; height: 21vh; display: flex;">
                                    <div style=" height: 21vh; width: 138px; overflow: hidden ">
                                        <img style="width: 97px" src="../book_img/1984.jpg" alt="">
                                    </div>
                                    <div style="width: 100%; height: 21vh; margin-left: 15px; ">
                                        <h6 style="font-size: 12px; font-weight: 700; font-style: italic">1984</h6>
                                        <div class="book_information_inventory" style="display: flex;">
                                            <div>
                                                <p>George Orwell</p>
                                                <p>Status: <span style="color: green; font-weight: 700">AVAILABLE</span></p>
                                            </div>
                                            <div style="margin-left: 20px">
                                                <p>Fiction</p>
                                                <p>Shelf: <span style="color: #711717; font-weight: 700">CN1023</span></p>
                                            </div>
                                        </div>
                                        <div  style="line-height: 15px; font-size: 10px; padding: 0px 0px 0px 5px;">
                                            <p>Description:</p>
                                            <p style="margin-top: -15px;">The story begins when a band of seven “uncool” 11-year-olds, led by Bill Denbrough, discovers and battles an evil, shape-changing monster that the children call “It.” It ....</p>
                                        </div>
                                    </div>

                                </div>
                                <div style="width: 96px; height: 18px; display: flex; justify-content: center; padding: 2px 0px 0px 0px;">
                                    <p style="font-size: 10px; font-weight: 600">Copies Left: 3</p>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    <button style="border: none; background: transparent; margin-right: 15px;"><img style="width: 17px" src="../icons/edit_profile_icon.png" alt=""></button>
                                    <button style="border: none; background: transparent"><img style="width: 20px" src="../icons/delete_book_inventory.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="width: 25rem; height: 250px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 0px 10px 0px 0px;">
                            <div class="card-body">
                                <h6 class="card-title"><input type="checkbox"></h6>
                                <div style="width: 100%; height: 21vh; display: flex;">
                                    <div style=" height: 21vh; width: 138px; overflow: hidden ">
                                        <img style="width: 97px" src="../book_img/1984.jpg" alt="">
                                    </div>
                                    <div style="width: 100%; height: 21vh; margin-left: 15px; ">
                                        <h6 style="font-size: 12px; font-weight: 700; font-style: italic">1984</h6>
                                        <div class="book_information_inventory" style="display: flex;">
                                            <div>
                                                <p>George Orwell</p>
                                                <p>Status: <span style="color: green; font-weight: 700">AVAILABLE</span></p>
                                            </div>
                                            <div style="margin-left: 20px">
                                                <p>Fiction</p>
                                                <p>Shelf: <span style="color: #711717; font-weight: 700">CN1023</span></p>
                                            </div>
                                        </div>
                                        <div  style="line-height: 15px; font-size: 10px; padding: 0px 0px 0px 5px;">
                                            <p>Description:</p>
                                            <p style="margin-top: -15px;">The story begins when a band of seven “uncool” 11-year-olds, led by Bill Denbrough, discovers and battles an evil, shape-changing monster that the children call “It.” It ....</p>
                                        </div>
                                    </div>

                                </div>
                                <div style="width: 96px; height: 18px; display: flex; justify-content: center; padding: 2px 0px 0px 0px;">
                                    <p style="font-size: 10px; font-weight: 600">Copies Left: 3</p>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    <button style="border: none; background: transparent; margin-right: 15px;"><img style="width: 17px" src="../icons/edit_profile_icon.png" alt=""></button>
                                    <button style="border: none; background: transparent"><img style="width: 20px" src="../icons/delete_book_inventory.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-12" style="background: rgb(246,246,247); height: 38vh; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2); display: flex; align-items: center; padding: 15px 5px 15px 15px; margin: 20px 0px 0px 0px;">
                        <div class="card" style="width: 25rem; height: 250px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 0px 10px 0px 0px;">
                            <div class="card-body">
                                <h6 class="card-title"><input type="checkbox"></h6>
                                <div style="width: 100%; height: 21vh; display: flex;">
                                    <div style=" height: 21vh; width: 138px; overflow: hidden ">
                                        <img style="width: 97px" src="../book_img/1984.jpg" alt="">
                                    </div>
                                    <div style="width: 100%; height: 21vh; margin-left: 15px; ">
                                        <h6 style="font-size: 12px; font-weight: 700; font-style: italic">1984</h6>
                                        <div class="book_information_inventory" style="display: flex;">
                                            <div>
                                                <p>George Orwell</p>
                                                <p>Status: <span style="color: green; font-weight: 700">AVAILABLE</span></p>
                                            </div>
                                            <div style="margin-left: 20px">
                                                <p>Fiction</p>
                                                <p>Shelf: <span style="color: #711717; font-weight: 700">CN1023</span></p>
                                            </div>
                                        </div>
                                        <div  style="line-height: 15px; font-size: 10px; padding: 0px 0px 0px 5px;">
                                            <p>Description:</p>
                                            <p style="margin-top: -15px;">The story begins when a band of seven “uncool” 11-year-olds, led by Bill Denbrough, discovers and battles an evil, shape-changing monster that the children call “It.” It ....</p>
                                        </div>
                                    </div>

                                </div>
                                <div style="width: 96px; height: 18px; display: flex; justify-content: center; padding: 2px 0px 0px 0px;">
                                    <p style="font-size: 10px; font-weight: 600">Copies Left: 3</p>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    <button style="border: none; background: transparent; margin-right: 15px;"><img style="width: 17px" src="../icons/edit_profile_icon.png" alt=""></button>
                                    <button style="border: none; background: transparent"><img style="width: 20px" src="../icons/delete_book_inventory.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="width: 25rem; height: 250px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 0px 10px 0px 0px;">
                            <div class="card-body">
                                <h6 class="card-title"><input type="checkbox"></h6>
                                <div style="width: 100%; height: 21vh; display: flex;">
                                    <div style=" height: 21vh; width: 138px; overflow: hidden ">
                                        <img style="width: 97px" src="../book_img/1984.jpg" alt="">
                                    </div>
                                    <div style="width: 100%; height: 21vh; margin-left: 15px; ">
                                        <h6 style="font-size: 12px; font-weight: 700; font-style: italic">1984</h6>
                                        <div class="book_information_inventory" style="display: flex;">
                                            <div>
                                                <p>George Orwell</p>
                                                <p>Status: <span style="color: green; font-weight: 700">AVAILABLE</span></p>
                                            </div>
                                            <div style="margin-left: 20px">
                                                <p>Fiction</p>
                                                <p>Shelf: <span style="color: #711717; font-weight: 700">CN1023</span></p>
                                            </div>
                                        </div>
                                        <div  style="line-height: 15px; font-size: 10px; padding: 0px 0px 0px 5px;">
                                            <p>Description:</p>
                                            <p style="margin-top: -15px;">The story begins when a band of seven “uncool” 11-year-olds, led by Bill Denbrough, discovers and battles an evil, shape-changing monster that the children call “It.” It ....</p>
                                        </div>
                                    </div>

                                </div>
                                <div style="width: 96px; height: 18px; display: flex; justify-content: center; padding: 2px 0px 0px 0px;">
                                    <p style="font-size: 10px; font-weight: 600">Copies Left: 3</p>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    <button style="border: none; background: transparent; margin-right: 15px;"><img style="width: 17px" src="../icons/edit_profile_icon.png" alt=""></button>
                                    <button style="border: none; background: transparent"><img style="width: 20px" src="../icons/delete_book_inventory.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="width: 25rem; height: 250px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 0px 10px 0px 0px;">
                            <div class="card-body">
                                <h6 class="card-title"><input type="checkbox"></h6>
                                <div style="width: 100%; height: 21vh; display: flex;">
                                    <div style=" height: 21vh; width: 138px; overflow: hidden ">
                                        <img style="width: 97px" src="../book_img/1984.jpg" alt="">
                                    </div>
                                    <div style="width: 100%; height: 21vh; margin-left: 15px; ">
                                        <h6 style="font-size: 12px; font-weight: 700; font-style: italic">1984</h6>
                                        <div class="book_information_inventory" style="display: flex;">
                                            <div>
                                                <p>George Orwell</p>
                                                <p>Status: <span style="color: green; font-weight: 700">AVAILABLE</span></p>
                                            </div>
                                            <div style="margin-left: 20px">
                                                <p>Fiction</p>
                                                <p>Shelf: <span style="color: #711717; font-weight: 700">CN1023</span></p>
                                            </div>
                                        </div>
                                        <div  style="line-height: 15px; font-size: 10px; padding: 0px 0px 0px 5px;">
                                            <p>Description:</p>
                                            <p style="margin-top: -15px;">The story begins when a band of seven “uncool” 11-year-olds, led by Bill Denbrough, discovers and battles an evil, shape-changing monster that the children call “It.” It ....</p>
                                        </div>
                                    </div>

                                </div>
                                <div style="width: 96px; height: 18px; display: flex; justify-content: center; padding: 2px 0px 0px 0px;">
                                    <p style="font-size: 10px; font-weight: 600">Copies Left: 3</p>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    <button style="border: none; background: transparent; margin-right: 15px;"><img style="width: 17px" src="../icons/edit_profile_icon.png" alt=""></button>
                                    <button style="border: none; background: transparent"><img style="width: 20px" src="../icons/delete_book_inventory.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 30px; display: flex; width: 100%;">
                        <div>
                            <img style="width: 180px;" src="../icons/pagination_sample.png" alt="">
                        </div>
                        <div style="display: flex; justify-content: flex-end; width: 100%; font-size: 10px;  ">
                            <button style="color: #800000;font-weight: 700; border-radius: 5px; border: 1px solid #740000; width: 100px; height: 28px; background: transparent; margin-right: 35px;">CANCEL</button>
                            <button style="color: #800000;font-weight: 700; border-radius: 5px; border: 1px solid #740000; width: 100px; height: 28px; background: transparent; ">DELETE ALL</button>


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const listItems = document.querySelectorAll('li');
    listItems.forEach((listItem) => {
        listItem.addEventListener('click', () => {
            listItems.forEach((item) => {
                item.classList.remove('active');
            });

            listItem.classList.add('active');
        });
    });
</script>

<script>



</script>


</body>
</html>