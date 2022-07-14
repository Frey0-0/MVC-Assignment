<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/client/dashboard" =>"\Controller\ClientDashboard",
    "/client/auth" => "\Controller\Authenticate",
    "/client/newuser" => "\Controller\NewUser",
    "/client/requestbook" => "\Controller\RequestBook",
    "/client/returnbook" => "\Controller\ReturnBook",
    "/client/logout" => "\Controller\LogOut",
    "/admin/addbook" => "\Controller\AddBook",
    "/admin/removebook" => "\Controller\RemoveBook",
    "/admin/auth" => "\Controller\Authorize",
    "/admin/dashboard" =>"\Controller\AdminDashboard",
    "/admin/logout" => "\Controller\LogOut",
    "/admin/approved" => "\Controller\Approved",
    "/admin/disapproved" => "\Controller\Disapproved",
    "/admin/approvedreturn" => "\Controller\ApprovedReturn",
    "/admin/disapprovedreturn" => "\Controller\DisapprovedReturn",
    "/admin/newadmin" => "\Controller\NewAdmin",
    "/admin/approvedadmin" => "\Controller\ApprovedAdmin",
    "/admin/disapprovedadmin" => "\Controller\DisapprovedAdmin",
    "/client/requestedbooks" => "\Controller\RequestedBooks",
    "/client/rejectedrequests" => "\Controller\RejectedRequests",
    "/admin/checkin_out" => "\Controller\CheckinCheckout",
    "/admin/showadminreq" => "\Controller\AdminReq"
));
