@charset "utf-8";

html { height: 100%; }
body { padding: 0px; color: #333; font-family: dotum; font-size: 12px; background:#fff; }
h1, h2, h3, h4, h5, h6 { font-family: "Open Sans", sans-serif; font-weight: 300; }
h1 { margin-top:40px; margin-bottom:20px; letter-spacing:0px; }
a {	outline: 0px; color: #333; text-decoration: none; }
a:focus { outline: 0px; color: crimson; text-decoration: none; }
a:hover { outline: 0px; color: crimson; text-decoration: none; }
a:active { outline: 0px; color: crimson; text-decoration: none; }
.en { font-family: "Open Sans", sans-serif; }
.font-8 { font-size: 8px; }
.font-9 { font-size: 9px; }
.font-10 { font-size: 10px; }
.font-11 { font-size: 11px; }
.font-12 { font-size: 12px; }
.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }
.font-16 { font-size: 16px; }
.font-18 { font-size: 18px; }
.cursor { cursor:pointer }

/* Colorset */
.red { color: rgb(233, 27, 35); }
.orange { color: rgb(243, 156, 18); }
.green { color: rgb(142, 196, 73); }
.violet { color: rgb(86, 61, 124); }
.yellow { color: rgb(241, 196, 15); }
.blue { color: rgb(52, 152, 219); }
.gray { color: rgb(136, 136, 136); }
.lightgray { color: rgb(208, 208, 208); }
.white { color: rgb(255, 255, 255); }
.black { color: rgb(31, 31, 31); }

.bg-red { background-color: rgb(233, 27, 35); color: rgb(255, 255, 255); }
.bg-orange { background-color: rgb(243, 156, 18); color: rgb(255, 255, 255); }
.bg-green { background-color: rgb(142, 196, 73); color: rgb(255, 255, 255); }
.bg-violet { background-color: rgb(86, 61, 124); color: rgb(255, 255, 255); }
.bg-yellow { background-color: rgb(241, 196, 15); color: rgb(255, 255, 255); }
.bg-blue { background-color: rgb(52, 152, 219); color: rgb(255, 255, 255); }
.bg-gray { background-color: rgb(136, 136, 136); color: rgb(255, 255, 255); }
.bg-lightgray { background-color: rgb(208, 208, 208); color: rgb(255, 255, 255); }
.bg-white { background-color: rgb(255, 255, 255); color: rgb(31, 31, 31); }
.bg-black { background-color: rgb(51, 51, 51); color: rgb(255, 255, 255); }

/* GNU Name Layer */
.member, .guest { color: rgb(51, 51, 51); }
.nav .member { color: #999 !important; }
#nameContextMenu { background:#000; color:#fff; padding:4px 8px 6px; }
#nameContextMenu a { color:#fff; font-size:12px; line-height:20px; display:block; }
#nameContextMenu a:hover { color:#ff0000; }
#nameContextMenu td { border:0px !important; }

/* Login & Register */
#sub-wrapper { width: 100%; height: 100%; display: table; background:#333 url('./images/bg.jpg'); }

.sub-container .box-login { left: 50%; top: 50%; width: 430px; margin-top:-200px; margin-left: -215px; position: absolute; }
.sub-container .box-register { left: 50%; top: 100px; width: 600px; margin-left: -300px; position: absolute; margin-bottom:50px; }
.sub-container .box-block { background:#fff; padding: 0px; border-radius: 2px; border: 0px currentColor; border-image: none; overflow: hidden; margin-bottom: 20px; box-shadow: 0px 1px 5px rgba(0,0,0,0.6); -webkit-border-radius: 2px; }
.sub-container .box-block .header { background: rgb(36, 148, 242); padding: 9px 20px; border-bottom-color: rgb(32, 130, 213); border-bottom-width: 1px; border-bottom-style: solid; }
.sub-container .box-block .header h3 {	margin: 0px; color: rgb(255, 255, 255); line-height: 35px; text-shadow: 0px -1px 0px rgba(0,0,0,0.3); }
.sub-container .box-block .content { padding: 30px 30px 5px; }
.sub-container .box-block .content .form-control {	padding: 10px 8px; height: auto; }
.sub-container .box-block .content .form-group { margin-bottom: 10px; }
.sub-container .box-block .content .title { margin-top: 0px; margin-bottom: 20px; }
.sub-container .box-block .foot { padding: 0px 30px 15px; text-align: right; }
.sub-container .box-block .foot .btn {	min-width: 70px; }
.sub-container .box-block .input-group-addon {	background: rgb(250, 250, 250); }
.sub-container .box-links {	padding-right: 3px; }
.sub-container .box-links a { color: rgb(201, 212, 246); text-shadow: 1px 1px 0px rgba(0,0,0,0.2); }
.sub-container .form-group { margin-top: 10px; }
.sub-container .form-control {	padding: 6px 8px; border-radius: 1px; font-size: 12px; box-shadow: inset 0px 1px 1px rgba(0,0,0,0.05); -webkit-border-radius: 1px; }
.sub-container .input-group .btn {	margin: 0px 0px 0px -1px !important; line-height: 20px; padding-top: 6px; padding-bottom: 6px; box-shadow: none; }
.sub-container .input-group-btn > .btn + .btn { margin-left: -5px !important; }
.sub-container .input-group-lg > .input-group-addon { border-radius: 3px 0px 0px 3px; line-height: 0.33; -webkit-border-radius: 3px 0 0 3px; }
.sub-container .input-group-addon { padding: 6px 11px; border-radius: 2px; -webkit-border-radius: 2px; }
.sub-container .form-control:focus { border-color: rgb(37, 152, 249); box-shadow: inset 0px 1px 1px rgba(0,0,0,0.05); }
.sub-container select.form-control { padding: 6px 8px; }
.sub-container textarea.form-control { padding: 6px 8px; }
.sub-container .input-group { margin-bottom: 15px; }

/* Button */
.btn { border-color: rgb(204, 204, 204); padding: 7px 11px; border-radius: 0px; font-size: 13px; box-shadow: 1px 1px 2px rgba(0,0,0,0.12), inset 1px 1px 0px rgba(255,255,255,0.2); -webkit-border-radius: 0; }
.btn-default { border-color: rgb(204, 204, 204); color: rgb(51, 51, 51); background-image: linear-gradient(rgb(255, 255, 255) 60%, rgb(249, 249, 249) 100%); background-color: rgb(255, 255, 255); }
.btn-default:focus { border-color: rgb(204, 204, 204); color: rgb(51, 51, 51); background-image: linear-gradient(rgb(255, 255, 255) 60%, rgb(249, 249, 249) 100%); background-color: rgb(255, 255, 255); }
.btn-default i { color: rgb(68, 68, 68); }
.btn-primary { border-color: rgb(54, 128, 191); background-color: rgb(77, 144, 253); }
.btn-primary:focus { border-color: rgb(54, 128, 191); background-color: rgb(77, 144, 253); }
.btn-primary:hover { border-color: rgb(53, 126, 189); background-color: rgb(78, 157, 255); }
.btn-primary:active { border-color: rgb(53, 126, 189); background-color: rgb(78, 157, 255); }
.active.btn-primary { border-color: rgb(53, 126, 189); background-color: rgb(78, 157, 255); }
.open .btn-primary.dropdown-toggle { border-color: rgb(53, 126, 189); background-color: rgb(78, 157, 255); }
.btn-primary:active { box-shadow: inset 0px 3px 5px rgba(0,0,0,0.125); }
.btn-success { border-color: rgb(84, 167, 84); background-color: rgb(96, 192, 96); }
.btn-success:focus { border-color: rgb(84, 167, 84); background-color: rgb(96, 192, 96); }
.btn-success:hover { border-color: rgb(84, 167, 84); background-color: rgb(101, 202, 101); }
.btn-success:active { border-color: rgb(84, 167, 84); background-color: rgb(101, 202, 101); }
.active.btn-success { border-color: rgb(84, 167, 84); background-color: rgb(101, 202, 101); }
.open .btn-success.dropdown-toggle { border-color: rgb(84, 167, 84); background-color: rgb(101, 202, 101); }
.btn-info { border-color: rgb(40, 161, 196); background-color: rgb(91, 192, 222); }
.btn-info:focus { border-color: rgb(40, 161, 196); background-color: rgb(91, 192, 222); }
.btn-info:hover { border-color: rgb(40, 161, 196); background-color: rgb(95, 200, 231); }
.btn-info:active { border-color: rgb(40, 161, 196); background-color: rgb(95, 200, 231); }
.active.btn-info { border-color: rgb(40, 161, 196); background-color: rgb(95, 200, 231); }
.open .btn-info.dropdown-toggle { border-color: rgb(40, 161, 196); background-color: rgb(95, 200, 231); }
.btn-warning { border-color: rgb(227, 136, 0); background-color: rgb(255, 153, 0); }
.btn-warning:focus { border-color: rgb(227, 136, 0); background-color: rgb(255, 153, 0); }
.btn-warning:hover { background-color: rgb(255, 168, 0); }
.btn-warning:active { background-color: rgb(255, 168, 0); }
.active.btn-warning { background-color: rgb(255, 168, 0); }
.open .btn-warning.dropdown-toggle { background-color: rgb(255, 168, 0); }
.btn-danger { border-color: rgb(202, 69, 46); background-color: rgb(223, 75, 51); }
.btn-danger:focus { border-color: rgb(202, 69, 46); background-color: rgb(223, 75, 51); }
.btn-danger:hover { background-color: rgb(230, 77, 53); }
.btn-danger:active { background-color: rgb(230, 77, 53); }
.active.btn-danger { background-color: rgb(230, 77, 53); }
.open .btn-danger.dropdown-toggle { background-color: rgb(230, 77, 53); }
.btn i { font-size: 14px; margin-right: 2px; display: inline-block; min-width: 10px; }
.btn-lg { padding: 12px 14px; font-size: 15px; font-weight: 300; }
.btn-lg i { font-size: 18px; }
.btn-sm { padding: 4px 7px; font-size: 12px; }
.btn-sm i { font-size: 14px; }
.btn-xs { padding: 2px 6px; font-size: 11px; }
.btn-xs i { font-size: 12px; }

#wrapper { padding-left: 0;	min-width:100px; overflow:hidden; }
#page-wrapper {	width: 100%; padding: 5px 15px;	overflow:hidden; background:#fff; }
.navbar { background:#333 url("./images/bg.jpg"); border-bottom:1px solid #222; }
.navbar i { margin-right:2px; }
.navbar .photo { width:35px; height:35px; border:0px; border-radius:50%; margin-right:6px; margin-top:-7px; }
.navbar-brand span { color:#fff !important; }

select.form-control,
input.form-control,
textarea.form-control,
.input-group-addon,
.alert,
.well,
.panel, 
.panel-heading { box-shadow: none; -webkit-box-shadow: none; border-radius: 0px !important; }
.badge { font-size:11px; font-family:verdana; letter-spacing:-1px; }
.page-header { margin-top:15px; padding-bottom:0; }
.navbar-nav > li > a { padding-top: 12px; padding-bottom: 12px; }

@media (min-width:768px) {
	#wrapper { padding-left: 225px; }
	#page-wrapper { padding: 15px 25px; }
	.navbar-header { min-width:225px; }
	.side-nav { margin-left: -225px; left: 225px; width: 225px; position: fixed; top: 51px; height: 100%; font-size:14px; border-radius: 0; border: none; background:#333 url("./images/bg.jpg"); overflow-y: auto; }
	.side-nav li { border-bottom:1px solid #222; }
	.side-nav>li.dropdown>ul.dropdown-menu { position: relative; min-width: 225px; margin: 0; padding: 0; border: none; border-radius: 0; background-color: transparent; box-shadow: none; -webkit-box-shadow: none; }
	.side-nav>li.dropdown>ul.dropdown-menu>li>a { color: #999999; padding: 15px 15px 15px 25px; }
	.side-nav>li.dropdown>ul.dropdown-menu>li>a:hover,
	.side-nav>li.dropdown>ul.dropdown-menu>li>a.active,
	.side-nav>li.dropdown>ul.dropdown-menu>li>a:focus { color: #fff; background-color: #080808; }
	.side-nav>li { width: 225px; }
	.navbar-inverse .navbar-nav>li>a:hover,
	.navbar-inverse .navbar-nav>li>a:focus { background-color: #080808; }
	.navbar-collapse { padding-left: 15px !important; padding-right: 15px !important; }
}

@media (max-width:768px) {
	.sub-container .box-login { left: 0; top: 0; width: 100%; margin-top:0px; margin-left: 0px; position: relative; }
	.sub-container .box-register { left: 0%; top: 0px; width: 100%; margin-left:0px; position: relative; margin-bottom:50px; }
}

/* Nav Announcements */
.announcement-heading { font-size: 50px; margin:0; padding:0; line-height:60px; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; letter-spacing:-3px; }
.announcement-text { margin:0; padding:0; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; }

/* table */
.tbl { }
.tbl th { white-space:nowrap; }
.tbl th a { color:#fff !important; }
.tbl td { vertical-align:middle !important; }

/* Comment Media */
.comment-media { padding:10px 0px; margin-top:10px; border-top:1px solid #eee; }
.comment-media .photo i { background: rgb(245, 245, 245); padding: 15px; border-radius: 50%; width: 64px; height: 64px; text-align: center; color: rgb(143, 143, 143); font-size: 30px; display: inline-block; }
.comment-media .photo img { border-radius: 50%; width: 64px !important; height: 64px !important; display:inline-block; }
.comment-media .media { border-bottom:1px solid #eee; margin:7px 0px; padding:0px 0px 7px; }
.comment-media :first-child.media { border-top:0px; margin-top:0px; padding-top:0px; }
.comment-media h5 { margin:2px 0px; line-height: 22px; font-size:13px; }
.comment-media .media .media-body { padding-left:0px; }
.comment-media .media .media-info {	margin-left:10px; }
.comment-media .media .media-content { margin-top:8px; }
.comment-media .media .media-content img { max-width:100%; }
.comment-media .media .media-it { margin-top:10px; }
.comment-media .media .media-btn { margin-left:4px; }

/* Search, Review, Q & A Media */
.at-media { padding:10px 0px; margin-top:10px; border-top:1px solid #eee;  }
.at-media .photo i { background: rgb(238, 238, 238); padding: 15px; width: 60px; height: 60px; text-align: center; color: rgb(255, 255, 255); font-size: 30px; display: inline-block; }
.at-media .photo img { width: 60px !important; height: 60px !important; display:inline-block; }
.at-media .photo-ans i { background: rgb(245, 245, 245); padding: 15px; border-radius: 50%; width: 64px; height: 64px; text-align: center; color: rgb(143, 143, 143); font-size: 30px; display: inline-block; }
.at-media .photo-ans img { border-radius: 50%; width: 64px !important; height: 64px !important; display:inline-block; }
.at-media .media { border-top:1px solid #eee; margin:7px 0px; padding:7px 0px 0px; }
.at-media :first-child.media { border-top:0px; margin-top:0px; padding-top:0px; }
.at-media h5 { margin:0px 0px 4px; line-height:20px; font-size:14px; display:block; text-overflow:ellipsis; white-space:nowrap; word-wrap:normal; overflow:hidden; }
.at-media h5 .media-fa { font-size:11px; margin-left:4px; font-weight:normal !important; }
.at-media .media.media-reply { border:0px; border-top:1px solid #eee; margin:10px 0px 0px; padding:10px 0px 0px; }
.at-media .media .media-body { padding-left:0px; }
.at-media .media-item { font-size:12px; line-height:20px; display:block; text-overflow:ellipsis; white-space:nowrap; word-wrap:normal; overflow:hidden; }
.at-media .media-info { font-size:11px; display:block; text-overflow:ellipsis; white-space:nowrap; word-wrap:normal; overflow:hidden; }
.at-media .media-info i { margin-left:10px; }
.at-media .media-info i:first-child { margin-left:0px; }
.at-media .media .media-content { margin-top:15px; padding-top:15px; border-top:1px solid #eee; }
.at-media .media .media-content p { margin:0px; padding:0px; }
.at-media .media .media-resize img { max-width:100%; }
.at-media .media .media-ans { color: orangered; font-size: 10px; font-weight:bold; font-family:verdana; letter-spacing:-1px; }
.at-media .media .media-btn { margin-left:4px; }

.is-star i { margin-left:0 !important; }
.cke_sc { display:none; }
