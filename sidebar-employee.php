<div class="sidebar bg-light text-dark" id="side_nav">
    <div class="header-box bg-white px-2 pt-3 pb-3 d-flex align-items-center" style="height:65px">
        <img src="hand-coins.png" height="25" class="ms-3"><span class="text-dark fs-4 fw-bold ms-1 me-4">Payroll</span>
        <button class="btn d-md-none d-block close-btn px-1 py-0 text-dark ms-5"><i class="fal fa-stream"></i></button>
    </div>
    <ul class="list-unstyled px-2 text-dark bg-light mt-1">
        <li class=""><a href="payslips-management-employee.php"
                class="text-decoration-none px-3 py-2 d-block text-dark">
                <i class="fal fa-home"></i> Payslips
            </a></li>
        <li class=""><a href="leave-management-employee.php" class="text-decoration-none px-3 py-2 d-block text-dark"><i
                    class="fal fa-arrow-circle-left"> </i> Leave</a></li>
        <li class="active"><a href="attendance-management-employee.php"
                class="text-decoration-none px-3 py-2 d-block text-dark"><i class="fal fa-clock"></i>
                Attendance</a></li>
        <li class=""><a href="logout.php" class="text-decoration-none px-3 py-2 d-block text-dark"><i
                    class="fal fa-sign-out"></i>
                Logout</a></li>
        <li>
            <form action="time-inout.php" method="post" class="text-decoration-none d-block w-100">
                <input class="active  btn btn-dark btn-pill w-100" type="button" id="btntimeinout"
                    value="Time In / Out">
            </form>
        </li>
    </ul>
</div>