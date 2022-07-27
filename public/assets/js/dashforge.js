
$(function(){
	("use strict");

	feather.replace();

	////////// NAVBAR //////////

	// Initialize PerfectScrollbar of navbar menu for mobile only
	// if(window.matchMedia('(max-width: 991px)').matches) {
	//   const psNavbar = new PerfectScrollbar('#navbarMenu', {
	//     suppressScrollX: true
	//   });
	// }

	// Showing sub-menu of active menu on navbar when mobile
	function showNavbarActiveSub() {
		if (window.matchMedia("(max-width: 991px)").matches) {
			$("#navbarMenu .active").addClass("show");
		} else {
			$("#navbarMenu .active").removeClass("show");
		}
	}

	showNavbarActiveSub();
	$(window).resize(function () {
		showNavbarActiveSub();
	});

	// Initialize backdrop for overlay purpose
	$("body").append('<div class="backdrop"></div>');

	// Showing sub menu of navbar menu while hiding other siblings
	$(".navbar-menu .with-sub .nav-link").on("click", function (e) {
		e.preventDefault();
		$(this).parent().toggleClass("show");
		$(this).parent().siblings().removeClass("show");

		if (window.matchMedia("(max-width: 991px)").matches) {
			psNavbar.update();
		}
	});

	// Closing dropdown menu of navbar menu
	$(document).on("click touchstart", function (e) {
		e.stopPropagation();

		// closing nav sub menu of header when clicking outside of it
		if (window.matchMedia("(min-width: 992px)").matches) {
			var navTarg = $(e.target).closest(".navbar-menu .nav-item").length;
			if (!navTarg) {
				$(".navbar-header .show").removeClass("show");
			}
		}
	});

	$("#mainMenuClose").on("click", function (e) {
		e.preventDefault();
		$("body").removeClass("navbar-nav-show");
	});

	$("#sidebarMenuOpen").on("click", function (e) {
		e.preventDefault();
		$("body").addClass("sidebar-show");
	});

	// Navbar Search
	$("#navbarSearch").on("click", function (e) {
		e.preventDefault();
		$(".navbar-search").addClass("visible");
		$(".backdrop").addClass("show");
	});

	$("#navbarSearchClose").on("click", function (e) {
		e.preventDefault();
		$(".navbar-search").removeClass("visible");
		$(".backdrop").removeClass("show");
	});

	////////// SIDEBAR //////////

	// Initialize PerfectScrollbar for sidebar menu
	if ($("#sidebarMenu").length) {
		const psSidebar = new PerfectScrollbar("#sidebarMenu", {
			suppressScrollX: true,
		});

		// Showing sub menu in sidebar
		$(".sidebar-nav .with-sub").on("click", function (e) {
			e.preventDefault();
			$(this).parent().toggleClass("show");

			psSidebar.update();
		});
	}

	$("#mainMenuOpen").on("click touchstart", function (e) {
		e.preventDefault();
		$("body").addClass("navbar-nav-show");
	});

	$("#sidebarMenuClose").on("click", function (e) {
		e.preventDefault();
		$("body").removeClass("sidebar-show");
	});

	// hide sidebar when clicking outside of it
	$(document).on("click touchstart", function (e) {
		e.stopPropagation();

		// closing of sidebar menu when clicking outside of it
		if (!$(e.target).closest(".burger-menu").length) {
			var sb = $(e.target).closest(".sidebar").length;
			var nb = $(e.target).closest(".navbar-menu-wrapper").length;
			if (!sb && !nb) {
				if ($("body").hasClass("navbar-nav-show")) {
					$("body").removeClass("navbar-nav-show");
				} else {
					$("body").removeClass("sidebar-show");
				}
			}
		}
	});

	let themeMode = document.querySelector("#themeMode");
	let setMode = localStorage.getItem("mode");
	let darkTheme = `
		<style id="dfMode">
			body{background-color:#040508}a{color:#58a6ff}a:hover{color:#2f90ff}.df-logo,.df-logo:focus,.df-logo:hover{color:#fff}.navbar-header{background-color:#0c1019;border-bottom-width:0}.navbar-header .burger-menu:focus,.navbar-header .burger-menu:hover{color:#fff}.navbar-header .navbar-right .search-link{color:#97a3b9}.navbar-header .navbar-right .search-link:focus,.navbar-header .navbar-right .search-link:hover{color:#fff}.navbar-header .navbar-right .dropdown-message .dropdown-menu,.navbar-header .navbar-right .dropdown-notification .dropdown-menu{margin-top:16.5px}@media (min-width:992px){.navbar-header .navbar-right .dropdown-message .dropdown-menu,.navbar-header .navbar-right .dropdown-notification .dropdown-menu{margin-top:19px}}.navbar-menu-wrapper{background-color:#24324d}@media (min-width:992px){.navbar-menu-wrapper{background-color:transparent}}.navbar-menu-header{background-color:#1c273c;border-bottom-width:0}.navbar-menu-header a:last-child:focus,.navbar-menu-header a:last-child:hover{color:#fff}.navbar-menu .nav-link{color:#cdd4e0}.navbar-menu .nav-label{color:#596882}.navbar-menu-sub{border-width:0}@media (min-width:992px){.navbar-menu-sub{background-color:#24324d}}.navbar-menu-sub:before{opacity:0}.navbar-menu-sub:after{border-bottom-color:#24324d}.navbar-menu-sub .nav-sub-link{color:#cdd4e0}.dropdown-message .dropdown-link,.dropdown-notification .dropdown-link{color:#97a3b9}.dropdown-message .dropdown-link.new-indicator,.dropdown-notification .dropdown-link.new-indicator{color:#cdd4e0}.dropdown-message .dropdown-menu,.dropdown-notification .dropdown-menu{background-color:#24324d;border-width:0}.dropdown-message .dropdown-menu:before,.dropdown-notification .dropdown-menu:before{opacity:0}.dropdown-message .dropdown-menu:after,.dropdown-notification .dropdown-menu:after{border-bottom-color:#24324d}.dropdown-message .dropdown-header,.dropdown-notification .dropdown-header{color:#fff}.dropdown-message .dropdown-item,.dropdown-notification .dropdown-item{color:#97a3b9}.dropdown-message .dropdown-item:focus,.dropdown-message .dropdown-item:hover,.dropdown-notification .dropdown-item:focus,.dropdown-notification .dropdown-item:hover{background-color:#24324d}.dropdown-message .dropdown-item:focus .avatar:after,.dropdown-message .dropdown-item:hover .avatar:after,.dropdown-notification .dropdown-item:focus .avatar:after,.dropdown-notification .dropdown-item:hover .avatar:after{box-shadow:0 0 0 2px #24324d}.dropdown-message .media-body,.dropdown-notification .media-body{color:#97a3b9}.dropdown-message .media-body strong,.dropdown-notification .media-body strong{color:#fff}.dropdown-message .avatar:after,.dropdown-notification .avatar:after{box-shadow:0 0 0 2px #1c273c}.dropdown-message .dropdown-footer a:focus,.dropdown-message .dropdown-footer a:hover,.dropdown-notification .dropdown-footer a:focus,.dropdown-notification .dropdown-footer a:hover{color:#295fff}.dropdown-profile .dropdown-link:focus .avatar img,.dropdown-profile .dropdown-link:hover .avatar img{background-color:#3b4863}.dropdown-profile .dropdown-menu{background-color:#192235;border-width:0;margin-top:13px}@media (min-width:992px){.dropdown-profile .dropdown-menu{margin-top:14px}}.dropdown-profile .dropdown-menu:before{opacity:0}.dropdown-profile .dropdown-menu:after{border-bottom-color:#192235}.dropdown-profile .dropdown-menu h6{color:#fff}.dropdown-profile .dropdown-item{color:#97a3b9}.navbar-search-header{background-color:#1c273c;border-bottom-width:0}.navbar-search-header .form-control{color:#fff}.navbar-search-header .btn{color:#97a3b9}.navbar-search-header .btn:focus,.navbar-search-header .btn:hover{color:#fff}.navbar-search-body{background-color:#192235}.navbar-search-body a{border-color:#596882;color:#97a3b9}.navbar-search-body a:focus,.navbar-search-body a:hover{background-color:#295fff;border-color:transparent;color:#fff}.aside-header{background-color:#0c1019;border-right-color:hsla(0,0%,100%,.06)}.aside-logo,.aside-logo:focus,.aside-logo:hover,.aside-menu-link:focus,.aside-menu-link:hover{color:#fff}.aside-body{background-color:#0c1019;border-right-width:0}.aside-alert-link a{color:hsla(0,0%,100%,.5)}.aside-alert-link a:focus,.aside-alert-link a:hover{color:#fff}.aside-alert-link a.new:before{box-shadow:0 0 0 2px #1c273c}.aside-loggedin-user a:focus,.aside-loggedin-user a:hover{color:#fff}.nav-aside .nav-label{color:#596882;font-weight:600}.nav-aside .nav-item ul a{color:#97a3b9}.nav-aside .nav-item ul a:focus,.nav-aside .nav-item ul a:hover{color:#fff}.nav-aside .nav-item.active .nav-link:focus svg,.nav-aside .nav-item.active .nav-link:hover svg{color:#295fff}.nav-aside .with-sub.show:not(.active) .nav-link{color:#fff}.nav-aside .with-sub.show:not(.active) .nav-link:before{border-color:#cdd4e0}.nav-aside .with-sub.show:not(.active) .nav-link svg{fill:none;color:#fff}.nav-aside .nav-link{color:#b4bdce}.nav-aside .nav-link svg{stroke-width:1.8px;fill:hsla(0,0%,100%,.06);color:#b4bdce}.nav-aside .nav-link:focus,.nav-aside .nav-link:focus svg,.nav-aside .nav-link:hover,.nav-aside .nav-link:hover svg{color:#fff}.aside-backdrop{background-color:rgba(0,0,0,.5)}.content,.content-auth{color:#cdd4e0}.content .input-group-text{background-color:transparent;border-color:#3b4863;color:#cdd4e0}.content-header{background-color:#0c1019}.content-header .nav-link{color:hsla(0,0%,100%,.5)}.content-header .nav-link:focus,.content-header .nav-link:hover{color:#fff}.footer{background-color:#0c1019;border-top-width:0}.footer a{color:#97a3b9}.footer a:focus,.footer a:hover{color:#fff}::-webkit-calendar-picker-indicator{filter:invert(1)}::-moz-calendar-picker-indicator{filter:invert(1)}.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{color:#fff}.breadcrumb-style1 .breadcrumb-item a,.breadcrumb-style2 .breadcrumb-item a,.breadcrumb-style3 .breadcrumb-item a{color:#7987a1}.breadcrumb-style1 .breadcrumb-item+.breadcrumb-item:before{color:#596882;font-weight:400}.card{background-color:#1c273c;border-width:0;color:#97a3b9}.list-label{background-color:#192235}.list-item,.list-label{border-color:#24324d}.list-group-item{background-color:inherit;border-color:hsla(0,0%,100%,.025)}.dropdown-divider{border-color:hsla(0,0%,100%,.06)}.link-01{color:hsla(0,0%,100%,.85)}.link-01:focus,.link-01:hover{color:#fff}.link-02{color:#cdd4e0}.link-02:focus,.link-02:hover,.link-03:focus,.link-03:hover{color:#fff}.progress{background-color:#596882}.tx-color-01{color:#fff}.tx-color-02{color:#cdd4e0}.tx-color-04{color:rgba(89,104,130,.7)}.table{color:#cdd4e0}.divider-text:after,.divider-text:before{background-color:#24324d}.form-control{background-color:transparent;border-color:#3b4863;color:#fff}.form-control::-moz-placeholder{color:#596882}.form-control:-ms-input-placeholder{color:#596882}.form-control::placeholder{color:#596882}.form-control:focus{background-color:transparent;color:#fff}.nav-classic .nav-link{color:#97a3b9}.nav-link.disabled{color:#596882!important}.img-group .img{background-color:#1c273c}.search-form button{border-color:#3b4863}.modal-content{background-color:#1c273c;color:#fff}.custom-select{background:transparent url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg" width="4" height="5"><path fill="%23fff" d="M2 0 0 2h4zm0 5L0 3h4z"/></svg>') right .625rem center/8px 10px no-repeat;border-color:#3b4863}.custom-select:not(:empty){color:#fff}.bd-bottom{border-bottom:1px solid #3b4863!important}.form-control:disabled,.form-control[readonly]{background-color:#0c1019}.df-example{background-color:#040508;border-color:#3b4863}.df-example:before{color:#fff}.custom-file-label{background-color:transparent;border-color:#3b4863}.custom-file-label:after{background-color:#3b4863;color:#fff}.bg-dark{color:#fff!important}.bg-dark a{color:#fff}.chosen-container-multi .chosen-choices,.chosen-container-single .chosen-single{border-color:#3b4863}.chosen-container-multi .chosen-choices li.search-field input[type=text],.chosen-container-single .chosen-single span{color:#fff!important}.table-dark{background-color:transparent}.table-dark thead{background-color:#283143}.table-dark tbody,.table-dark thead th{color:#fff!important}.table-dark tbody td{border-color:transparent!important}div.dt-button-collection{background-color:#3b4863!important}div.dt-button-collection .dt-button a{color:#fff!important}div.dt-button-collection .dt-button:not(.active){background-color:#e3e7ed!important}div.dt-button-collection .dt-button:not(.active) a{color:#1c273c!important}div.dt-button-info{background-color:#3b4863!important;color:#fff!important}div.dt-button-info h2{background-color:#596882!important;border-color:#7987a1!important}.custom-file-label-alt:focus,.custom-file-label-alt:hover{color:#4372ff}.bd,.bd-r,.bd-t{border-color:#24324d}.bd-info{border-color:#00b8d4}.bd-primary{border-color:#295fff}.bd-success{border-color:#10b759}.bd-warning{border-color:#ffc107}.bd-pink{border-color:#f10075}.bd-teal{border-color:#0cc}.bd-purple{border-color:#6f42c1}.table-dashboard tbody td,.table-dashboard tbody th,.table-dashboard thead th{border-color:hsla(0,0%,100%,.06)}.card-dashboard-table .table thead tr:first-child th{background-color:hsla(0,0%,100%,.05)}.table-dashboard-two tr+tr td{border-top-color:hsla(0,0%,100%,.06)}.chart-sixteen .flot-x-axis .flot-tick-label{color:hsla(0,0%,100%,.2);font-weight:400}.activity-body{color:hsla(0,0%,100%,.5)}.activity-body strong{color:#fff}.calendar-sidebar{background-color:#141c2b}.ui-datepicker{background-color:#192235}.ui-datepicker .ui-datepicker-calendar td{background-color:transparent;border:1px solid #192235}.ui-datepicker .ui-datepicker-calendar td a{color:#8392a5}.ui-datepicker .ui-datepicker-calendar td.ui-datepicker-other-month .ui-state-default{color:#3b4863}.ui-datepicker .ui-datepicker-calendar th{color:#8392a5}.ui-datepicker .ui-datepicker-calendar .ui-state-disabled .ui-state-default{background-color:#2c3e5f;color:#5977b2}.ui-datepicker .ui-datepicker-calendar .ui-datepicker-current-day a{background-color:#fff;color:#1c273c}.ui-datepicker .ui-datepicker-calendar a:hover{background-color:#596882!important;color:#b4bdce!important}.ui-datepicker .ui-datepicker-header .ui-datepicker-next:focus:before,.ui-datepicker .ui-datepicker-header .ui-datepicker-next:hover:before,.ui-datepicker .ui-datepicker-header .ui-datepicker-prev:focus:before,.ui-datepicker .ui-datepicker-header .ui-datepicker-prev:hover:before,.ui-datepicker .ui-datepicker-title{color:#fff}.calendar-inline .ui-datepicker .ui-datepicker-calendar td a{color:#7987a1}.calendar-inline .ui-datepicker .ui-datepicker-calendar td a:focus,.calendar-inline .ui-datepicker .ui-datepicker-calendar td a:hover{background-color:#24324d;color:#fff}.calendar-nav a{color:#97a3b9}.calendar-nav a:focus,.calendar-nav a:hover{background-color:#24324d;color:#fff}.calendar-content{background-color:transparent}.calendar-content-body .fc-toolbar button{background-color:#3b4863;border-width:0;color:#97a3b9}.calendar-content-body .fc-toolbar button.fc-state-active,.calendar-content-body .fc-toolbar button:focus,.calendar-content-body .fc-toolbar button:hover{background-color:#596882;color:#fff}.calendar-content-body .fc-toolbar button.fc-today-button{background-color:#3b4863;color:#97a3b9}.calendar-content-body .fc-toolbar button.fc-today-button:focus,.calendar-content-body .fc-toolbar button.fc-today-button:hover{background-color:#596882;color:#fff}.calendar-content-body .fc-toolbar button.fc-today-button.fc-state-disabled{background-color:#1c273c;color:#596882}.calendar-content-body .fc-agendaWeek-view .fc-head-container th{border-color:#1f2c43}.calendar-content-body .fc-divider{background-color:#192235;border-color:#1f2c43}.calendar-content-body .fc-head-container .fc-day-header{color:#97a3b9}.calendar-content-body .fc-other-month{background-color:#111724}.calendar-content-body td.fc-today{background-color:#192235}.calendar-content-body .fc-listMonth-view .fc-list-heading-main,.calendar-content-body .fc-listMonth-view .fc-list-heading-main:focus,.calendar-content-body .fc-listMonth-view .fc-list-heading-main:hover,.calendar-content-body .fc-listWeek-view .fc-list-heading-main,.calendar-content-body .fc-listWeek-view .fc-list-heading-main:focus,.calendar-content-body .fc-listWeek-view .fc-list-heading-main:hover{color:#97a3b9}.calendar-content-body .fc-listMonth-view .fc-list-heading-main span:last-child,.calendar-content-body .fc-listWeek-view .fc-list-heading-main span:last-child{color:#fff}.calendar-content-body .fc-listMonth-view .fc-list-item,.calendar-content-body .fc-listWeek-view .fc-list-item{background-color:#1c273c}.calendar-content-body .fc-listMonth-view .fc-list-item-title a,.calendar-content-body .fc-listWeek-view .fc-list-item-title a{color:#fff}.calendar-modal-create .modal-body{color:#97a3b9}.calendar-modal-create .modal-body h5{color:#fff}.calendar-modal-create .form-control{border-color:#596882;color:#97a3b9}.calendar-modal-create .form-control:focus{border-color:#7987a1;box-shadow:none}.calendar-modal-create select{background-color:transparent;border-color:#596882}.calendar-modal-create .custom-control-label:before{background-color:transparent;border-color:#596882;margin-top:1px}.calendar-modal-create .custom-control-label:after{margin-top:1px}.calendar-modal-event .modal-body{background-color:#1c273c}.calendar-modal-event .event-end-date,.calendar-modal-event .event-start-date{color:#cdd4e0}.close{color:#596882}.close:focus,.close:hover{color:#97a3b9}.chat-navleft{background-color:#172032}.chat-navleft .nav-link:not(.active){color:#97a3b9}.chat-navleft .nav-link:not(.active):focus,.chat-navleft .nav-link:not(.active):hover{color:#fff}.chat-sidebar{background-color:#141c2b}.chat-sidebar-header{background-color:#172032}.chat-sidebar-header .dropdown-link>span{color:#3b4863}.chat-sidebar-header .dropdown-link:focus>span,.chat-sidebar-header .dropdown-link:hover>span{color:#cdd4e0}.chat-sidebar-header .dropdown-menu{background-color:#192235}.chat-sidebar-header .dropdown-menu:before{border-bottom-color:hsla(0,0%,100%,.08)}.chat-sidebar-header .dropdown-menu:after{border-bottom-color:#192235}.chat-sidebar-header .dropdown-item{color:#97a3b9}.chat-sidebar-header .dropdown-item:focus,.chat-sidebar-header .dropdown-item:hover{background-color:#1f2c43;color:#fff}.nav-chat .nav-link{color:#97a3b9}.nav-chat .nav-link:focus,.nav-chat .nav-link:hover{background-color:#1c273c;color:#fff}.nav-chat .nav-link.active{background-color:#1f2c43;color:#295fff}.chat-msg-list .media:focus,.chat-msg-list .media:hover{background-color:#1c273c}.chat-msg-list .media:focus .avatar:after,.chat-msg-list .media:hover .avatar:after{box-shadow:0 0 0 2px #1c273c}.chat-msg-list .media.active{background-color:#1c273c}.chat-msg-list .avatar:after,.chat-msg-list .media.active .avatar:after{box-shadow:0 0 0 2px #1c273c}.chat-sidebar-footer{background-color:#172032}.chat-sidebar-footer .avatar:after{box-shadow:0 0 0 2px #1c273c}.chat-sidebar-footer a{color:#97a3b9}.chat-sidebar-footer a:focus,.chat-sidebar-footer a:hover{color:#fff}.chat-content{background-color:#141c2b}.chat-content-header{background-color:#172032}.chat-content-header .avatar:after{box-shadow:0 0 0 2px #1c273c}.chat-content-header nav a{color:#97a3b9}.chat-content-header nav a:focus,.chat-content-header nav a:hover{color:#fff}.chat-content-header nav a.active{color:#295fff}.chat-content-header .search-form .btn,.chat-content-header .search-form .form-control{border-color:hsla(0,0%,100%,.08)}.chat-content-header .search-form .form-control:focus,.chat-content-header .search-form .form-control:focus+.btn{border-color:#3b4863}.chat-content-header .search-form .btn:focus,.chat-content-header .search-form .btn:hover{color:#fff}.chat-content-body{color:#97a3b9}.chat-content-body .avatar:after{box-shadow:0 0 0 2px #1c273c}.chat-group .media-body h6 small{color:#596882}.chat-group-divider:after,.chat-group-divider:before{background-color:hsla(0,0%,100%,.06)}.chat-content-footer{background-color:#172032}.chat-content-footer .chat-plus{color:#97a3b9}.chat-content-footer .chat-plus:focus,.chat-content-footer .chat-plus:hover{color:#fff}.chat-content-footer .form-control{color:#cdd4e0}.chat-content-footer .form-control::-moz-placeholder{color:#3b4863}.chat-content-footer .form-control:-ms-input-placeholder{color:#3b4863}.chat-content-footer .form-control::placeholder{color:#3b4863}.chat-content-footer nav a{color:#97a3b9}.chat-content-footer nav a:focus,.chat-content-footer nav a:hover{color:#fff}.chat-sidebar-right{background-color:#172032}.chat-sidebar-right .avatar:after{box-shadow:0 0 0 2px #1c273c}.chat-member-list .media:focus,.chat-member-list .media:hover{background-color:#24324d}.app-chat .modal-body h6{color:#cdd4e0}.app-chat .modal-body .form-control{background-color:transparent;border-color:#596882;color:#cdd4e0}.app-chat .modal-body .btn-outline-light{border-color:#596882}.contact-navleft{background-color:#172032}.contact-navleft .nav-link{color:hsla(0,0%,100%,.5)}.contact-navleft .nav-link:focus,.contact-navleft .nav-link:hover{color:#fff}.contact-sidebar{background-color:#141c2b}.contact-sidebar-header{background-color:#172032}.contact-list .media .avatar:after{box-shadow:0 0 0 2px #141c2b}.contact-list .media:focus,.contact-list .media:hover{background-color:#1c273c;color:#fff}.contact-list .media:focus .avatar:after,.contact-list .media:hover .avatar:after{box-shadow:0 0 0 2px #1c273c}.contact-list .media.active{background-color:#1f2c43}.contact-list .media.active .avatar:after{box-shadow:0 0 0 2px #1f2c43}.contact-list-divider:after,.contact-list-divider:before{background-color:#212e46}.contact-content{background-color:#141c2b}.contact-content-header{background-color:#172032}.contact-content-body{color:hsla(0,0%,100%,.8)}.contact-content-body .nav-social .nav-link{color:#cdd4e0}.contact-content-body .nav-social .nav-link:focus,.contact-content-body .nav-social .nav-link:hover{color:#295fff}.contact-content-sidebar{background-color:#172032;color:#cdd4e0}.contact-content-nav .nav-link{color:#fff}.contact-content-nav .nav-link:focus,.contact-content-nav .nav-link:hover{color:#295fff}.filemgr-sidebar{background-color:#141c2b}.filemgr-sidebar-header{background-color:#172032}.filemgr-sidebar-header .dropdown-menu{background-color:#293958;border-width:0}.filemgr-sidebar-header .dropdown-item{color:#cdd4e0}.filemgr-sidebar-header .dropdown-item:focus,.filemgr-sidebar-header .dropdown-item:hover{background-color:#212e46;color:#fff}.filemgr-sidebar-body,.filemgr-sidebar-body .nav-sidebar .nav-link{color:#97a3b9}.filemgr-sidebar-body .nav-sidebar .nav-link:focus,.filemgr-sidebar-body .nav-sidebar .nav-link:hover{background-color:#1c273c;color:#fff}.filemgr-sidebar-body .nav-sidebar .nav-link.active{background-color:#1f2c43}.filemgr-content-body{background-color:#141c2b}.dropdown-file .dropdown-link:focus,.dropdown-file .dropdown-link:hover{color:#cdd4e0}.dropdown-file .dropdown-menu{background-color:#293958;border-width:0}.dropdown-file .dropdown-item{color:#cdd4e0}.dropdown-file .dropdown-item:focus,.dropdown-file .dropdown-item:hover{background-color:#212e46;color:#fff}.card-file-thumb{background-color:#192235}.media-folder{background-color:#1c273c;border-width:0}.app-mail .backdrop{visibility:hidden}.mail-sidebar{background-color:#141c2b}.mail-sidebar-body .nav-sidebar .nav-link{color:#97a3b9}.mail-sidebar-body .nav-sidebar .nav-link:focus,.mail-sidebar-body .nav-sidebar .nav-link:hover{background-color:#1c273c;color:#fff}.mail-sidebar-body .nav-sidebar .nav-link.active{background-color:#1f2c43}.mail-group{background-color:#141c2b}.mail-group-header{background-color:#172032}.mail-group-label{background-color:#111724}.mail-group-body .media{background-color:transparent}.mail-group-body .media:focus,.mail-group-body .media:hover{background-color:#192235}.mail-group-body .media+.media{border-top-color:#1c273c}.mail-group-body .media.unread,.mail-group-body .media.unread:focus,.mail-group-body .media.unread:hover{background-color:#1c273c}.mail-group-body .media.selected,.mail-group-body .media.selected:focus,.mail-group-body .media.selected:hover{background-color:#24324d}.mail-content{background-color:#141c2b}.mail-content-header{background-color:#172032}.mail-content-body{background-color:transparent;color:#97a3b9}.mail-content-body .ql-editor{color:#97a3b9}.mail-content-body .ql-snow.ql-toolbar button .ql-stroke{stroke:#596882}.mail-content-body .ql-snow.ql-toolbar button:focus,.mail-content-body .ql-snow.ql-toolbar button:hover{background-color:#1c273c}.mail-content-body .ql-snow.ql-toolbar button:focus .ql-stroke,.mail-content-body .ql-snow.ql-toolbar button:hover .ql-stroke{stroke:#fff}.mail-compose-body{background-color:#172032;border-width:0;box-shadow:none;color:#97a3b9}.mail-compose-body .form-control{background-color:transparent}.mail-compose-body .form-control::-moz-placeholder{color:#596882}.mail-compose-body .form-control:-ms-input-placeholder{color:#596882}.mail-compose-body .form-control::placeholder{color:#596882}.mail-compose-body .ql-editor{color:#97a3b9}.mail-compose-body .ql-snow.ql-toolbar button .ql-stroke{stroke:#596882}.mail-compose-body .ql-snow.ql-toolbar button:focus,.mail-compose-body .ql-snow.ql-toolbar button:hover{background-color:#1c273c}.mail-compose-body .ql-snow.ql-toolbar button:focus .ql-stroke,.mail-compose-body .ql-snow.ql-toolbar button:hover .ql-stroke{stroke:#fff}.page-profile .avatar:after{box-shadow:0 0 0 1.5px #141c2b}.list-inline-skills .list-inline-item a{background-color:#1c273c;border-color:#212e46;color:#97a3b9}.profile-info-list a{color:#97a3b9}.dataTables_wrapper .select2-container--default .select2-selection--single{background-color:transparent;border-color:#3b4863!important}.dataTables_wrapper .select2-container--default .select2-selection--single .select2-selection__rendered{color:#fff}.dataTables_wrapper .select2-container--default .select2-selection--single .select2-selection__arrow b{border-top-color:#fff!important}.dataTables_wrapper .dataTables_info,.dataTables_wrapper .dataTables_length{color:#cdd4e0}.dataTables_wrapper .dataTables_filter input{background-color:transparent;border-color:#3b4863!important;color:#fff}.dataTables_wrapper .dataTables_paginate .paginate_button{background-color:#3b4863!important;color:#fff!important}.dataTables_wrapper .dataTables_paginate .paginate_button:hover{background-color:#283143!important;color:#fff!important}.dataTables_wrapper .dataTables_paginate .paginate_button.current{background-color:#295fff!important}table.dataTable thead .sorting_asc,table.dataTable thead .sorting_desc,table.dataTable thead th.sorting_1{background-color:#313c53}table.dataTable tbody td{font-weight:200}table.dataTable tbody td.sorting_1{background-color:#313c53}table.dataTable tbody tr{background-color:#0f1520}table.dataTable tbody tr:hover,table.dataTable tbody tr:hover td.sorting_1{background-color:#3b4863!important}.bg-checkbox{background-color:#313c53}.row-selected,table.dataTable tbody tr.row-selected td.bg-checkbox,table.dataTable tbody tr.row-selected td.sorting_1{background-color:#4d7aff!important}table.dataTable tbody tr:hover td.bg-checkbox,table.dataTable tbody tr:hover td.sorting_1{background-color:#3b4863!important}table.dataTable tbody tr td .nav-link{color:#fff}table.dataTable tbody tr td .nav-link:hover{color:#5c85ff}.df-settings .bd-t{border-color:rgba(72,94,144,.25)}.df-settings-link{border-width:0;box-shadow:none}.df-settings-body{border-left-width:0}
/*# sourceMappingURL=skin.dark.css.map */
		</style>
	`;

	if(!setMode) {
		localStorage.setItem("mode", "light");
	}

	const themeModeChange = () => {
		let setMode = localStorage.getItem("mode");
		if (setMode === "light") {
			$("#dfMode").remove();
			$("#themeMode svg").remove();
			$("#themeMode").append(
				`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>`
			);
			$(".btn-dark").addClass("btn-white").removeClass("btn-dark");
			$(".bg-dark").addClass("bg-white").removeClass("bg-dark");
			$(".table-dark").addClass("table-light").removeClass("table-dark");
		} else {
			$("#themeMode svg").remove();
			$("#themeMode").append(
				`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>`
			);
			$("head").append(darkTheme);
			$(".btn-white").addClass("btn-dark").removeClass("btn-white");
			$(".bg-white").addClass("bg-dark").removeClass("bg-white");
			$(".table-light").addClass("table-dark").removeClass("table-light");
		}
	}
	themeModeChange();
	let base_url = window.location.origin;
	console.log(base_url);

	themeMode.addEventListener("click", () => {
		let setMode = localStorage.getItem("mode");
		if(setMode === "light") {
			localStorage.setItem("mode", "dark");
		} else {
			localStorage.setItem("mode", "light");
		}
		themeModeChange();
	});
	// if (
	// 	window.matchMedia &&
	// 	window.matchMedia("(prefers-color-scheme: dark)").matches
	// ) {
	// 	$("head").append(
	// 		'<link id="dfMode" rel="stylesheet" href="assets/css/skin.dark.css">'
	// 	);
	// 	$(".btn-white").addClass("btn-dark").removeClass("btn-white");
	// 	$(".bg-white").addClass("bg-dark").removeClass("bg-white");
	// 	$(".table-light").addClass("table-dark").removeClass("table-light");
	// }

	// window
	// 	.matchMedia("(prefers-color-scheme: dark)")
	// 	.addEventListener("change", (e) => {
	// 		const newColorScheme = e.matches ? "dark" : "light";

	// 		if (newColorScheme === "light") {
	// 			$("#dfMode").remove();
	// 			$(".btn-dark").addClass("btn-white").removeClass("btn-dark");
	// 			$(".bg-dark").addClass("bg-white").removeClass("bg-dark");
	// 			$(".table-dark").addClass("table-light").removeClass("table-dark");
	// 		} else {
	// 			$("head").append(
	// 				'<link id="dfMode" rel="stylesheet" href="assets/css/skin.dark.css">'
	// 			);
	// 			$(".btn-white").addClass("btn-dark").removeClass("btn-white");
	// 			$(".bg-white").addClass("bg-dark").removeClass("bg-white");
	// 			$(".table-light").addClass("table-dark").removeClass("table-light");
	// 		}
	// 	});



	/*** Handles the Select All Checkbox ***/
	$("#checkbox_all").click(function () {
		$(".cb").not(this).prop("checked", this.checked);
		if (this.checked) {
			$(".row_cb").addClass("row-selected");
		} else {
			$(".row_cb").removeClass("row-selected");
		}
	});

	$(".cb").change(function () {
		var id = $(this).attr("id").replace("cb", "");
		if (this.checked) {
			$("#row" + id).addClass("row-selected");
		} else {
			$("#row" + id).removeClass("row-selected");
		}
	});

	$("#btnSearch").on("click", function () {
		$("#searchForm").submit();
	});
	/*** END END Handles the Select All Checkbox END END ***/

	/*** Handles the Preloader ***/
	var Body = $("body");
	Body.addClass("preloader-site");
	
	$(window).on("load", function () {
		$(".preloader").fadeOut();
		$("body").removeClass("preloader-site");
	});
	/*** END Handles the Preloader ***/
})
