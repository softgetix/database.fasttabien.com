<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Fasttabien รับจองทะเบียนนรถกรุงเทพฯ ไวที่สุด การันตี</title>	
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link rel="icon" type="image/png" href="<?php echo base_url('frontend/img/logo.png');?>" />
  <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@400;600&display=swap" rel="stylesheet">

  <style type="text/css">
  	* {box-sizing:border-box;}
  	body {background:#e3e3ff; font-family: 'Mitr', sans-serif; color:#15181a; margin:0; padding:15px;}

  	.btn {display:inline-block; text-decoration:none; background:#7372fe; color:#fff; border:1px solid #7372fe; padding:10px 15px;margin:16px 10px 25px; border-radius:5px;}
  	.btn:hover {background:#fff; color:#7372fe;}

  	.content-wrapper {max-width:1165px; background:#fff; margin:45px auto; border-radius:8px; box-shadow:0 0 20px rgba(161,160,254,.75); overflow:hidden;}
  	.flex-row {display:flex; display:-ms-flexbox; -ms-flex-wrap:wrap; flex-wrap:wrap;}
  	.col {-ms-flex-preferred-size:0; flex-basis:0; -ms-flex-positive:1; flex-grow:1; max-width:100%;}

  	header {padding:45px;}
  	header .info-col {-ms-flex:0 0 100%; flex:0 0 100%; max-width:366px; width:100%;}
  	header .avatar {display:inline-block; width:66px; height:66px; background:#7372fe; border-radius:45px; text-align:center; line-height:88px; float:left; margin-right:15px;}
  	header .avatar svg {width:45px;}
  	header h3 {margin:10px 0 0;}
  	header p {margin:5px 0;}
  	header .tagline-col {font-size:14px;}

  	.avatar img{height: 117px;margin-left: -28px;margin-top: -15px;}

  	.contact-row {color:#fff; background:#7372fe; font-size:14px; text-align:center; padding:9px;}
  	.contact-row > span {display:inline-block; padding:6px 15px;}
  	.contact-row svg {width:16px; margin-right:5px;}
  	.contact-row .icon {position:relative;}
  	.contact-row .icon .copy {position:absolute; left:0;}
  	.contact-row .txt {display:inline-block; vertical-align:top;}


  	.number-groups .group .flex-row{width: 104%;}
  	.number-groups .group {margin:10px auto; padding:25px 45px; background:#ededfd; font-size:14px;text-align: left;}
  	.number-groups .group:nth-child(even) {background:#dbdbfb;}
  	.number-groups .title-row .txt {font-size:13px;}
  	.number-groups .number-col {-ms-flex:0 0 auto; flex:0 0 auto; width:auto; min-width:102px; max-width:100%; margin:20px 20px 20px 0;}
  	.number-groups .number-inner {box-shadow:0 3px 7px rgba(0,0,0,.14); background:#fff; text-align:center; border-radius:4px; overflow:hidden;}
  	/*.number-groups .sold-out .num {font-weight:400;}*/
  	.number-groups .num {display:block; padding:5px 5px 7px;}
  	.number-groups .location {display:block; background:#ededfd; border:1px solid #9e9efd; border-radius:4px; padding:1px 5px; margin:-6px 14px; position:relative;}
  	.number-groups .sold-out .price, .number-groups .number-col:not(.sold-out) .sold {display:none;}
  	.number-groups .price, .number-groups .sold {display:block; background:#7372fe; color:#fff; padding:9px 5px 3px;}
  	.number-groups .sold {background:#fb2b2b;}

  	.tagline-col p{margin-top: 13px;float: right;}

  	@media (max-width:767px) {
  		.content-wrapper {max-width:375px;}
  		header {padding:35px;}
  		header .tagline-col {text-align:center; padding:15px 10px 0;}
  		.contact-row > span {padding:6px 10px;}
  		.number-groups .group {padding:25px 15px;}
  		.number-groups .flex-row {-webkit-box-pack:justify!important;-ms-flex-pack:justify!important;}
  		.number-groups .title-row {margin-bottom:15px;}
  		.number-groups .number-col {margin: 20px 13px 20px 0;}
  		.number-groups .group .flex-row{width: 100%;}
  	}

  	@media (max-width:390px) {
  		.number-groups .flex-row {-ms-flex-pack:distribute!important;}
  		.number-groups .number-col {margin: 20px 6px 20px 0;}
  		.number-groups .group .flex-row{width: 100%;}
  	}

  </style>

</head>
<body>

	<div class="content-wrapper">
		<header class="flex-row">
			<div class="col info-col">
				<span class="avatar">
					<img src="<?php echo base_url('frontend/img/logo.png');?>">
				</span>
				<h3>Fasttabien รับจองทะเบียน</h3>
				<p>เลขแนะนำประจำหมวด - <?php echo $category['name']; ?></p>
			</div>

			
		</header>

		<div class="contact-row">
<p><?php echo $category['description'];?></p>
			<span class="msg">
				<svg  viewBox="0 0 172 172"> <use xlink:href="#line-msg"/> </svg>
				<span class="txt">ไลน์ @fasttabien</span>
			</span>
			
				
			<span class="whatsapp">
				<svg viewBox="0 0 1792 1792"> <use xlink:href="#whatsapp"/> </svg>
				<span class="txt">061-665-6656</span>
			</span>
		</div>

		<div class="number-groups">
		<?php if (!empty($data)){
			foreach ($data as $key => $group) { ?>
			<div class="group group-14">
				<div class="title-row">
					<strong><?php echo $group['name'];?></strong>
					<span class="txt"><?php echo $group['description'];?></span>
				</div>

				<div class="flex-row">
					<?php if (!empty($group['records'])) {
						foreach ($group['records'] as $key => $value) { ?>
							
						<div class="col number-col <?php echo $value['is_sold']?'sold-out':''?>">
							<div class="number-inner">
								<strong class="num"><?php echo $category['name'].'  '.$value['number'];?></strong>
								<span class="location"><?php echo $value['data'];?></span>
								<span class="price"><?php echo number_format($value['price']).' บาท';?></span>
								<strong class="sold">ติดจองแล้ว</strong>
							</div>
						</div> <!-- /.col -->
						
					<?php } } ?>
				</div> <!-- /.flex-row -->

			</div> <!-- /.group  -->
				
		<?php } }?>

		</div> <!-- /.number-groups -->

		<div style="text-align:center;">
			<a href="https://line.me/R/ti/p/%40fasttabien" target="_blank" class="btn">แอดไลน์</a>
			<a href="INBOX ในเพจ" target="_blank" class="btn">Inbox ในเพจ</a>
		</div>

	</div>




  <div id="define-all-svgs-here" style="display:none;">
    <svg>
      <defs>

      	<g id="car" fill="#ffffff"><path d="M86,57.33333c-24.07552,0 -31.35417,2.6875 -31.35417,2.6875c-5.06706,1.67969 -11.98177,4.08724 -14.78125,9.40625c-1.39974,2.6875 -6.80274,17.66472 -11.42187,30.90625h-5.82292c-2.63151,0 -5.375,2.07162 -6.27083,4.70313l-1.79167,4.92708c-0.89583,2.63151 0.50391,4.70313 3.13542,4.70313h5.82292c-0.16797,0.44792 -1.11979,3.35938 -1.11979,3.35938c-0.44792,0.78385 -0.89583,4.42318 -0.89583,5.375v43.44792c0,2.79948 2.35156,5.15104 5.15104,5.15104h18.36458c2.79948,0 5.15104,-2.35156 5.15104,-5.15104v-9.18229h71.66667v9.18229c0,2.79948 2.35156,5.15104 5.15104,5.15104h18.36458c2.79948,0 5.15104,-2.35156 5.15104,-5.15104v-43.44792c0,-0.95182 -0.44792,-4.59115 -0.89583,-5.375c0,0 -0.95182,-2.91146 -1.11979,-3.35937h5.82292c2.63151,0 4.03125,-2.07161 3.13542,-4.70312l-1.79167,-4.92708c-0.89583,-2.63151 -3.63932,-4.70312 -6.27083,-4.70312h-5.82292c-4.56315,-12.84961 -9.96615,-27.3789 -11.64583,-31.13021c-2.46354,-5.48698 -10.24609,-7.97851 -14.55729,-9.18229c0,0 -7.27865,-2.6875 -31.35417,-2.6875zM86,67.85938c36.42122,0 37.31706,6.41081 37.40104,6.49479c1.11979,3.35938 5.62695,13.54948 9.18229,27.99479c0,0 -15.45312,5.15104 -46.58333,5.15104c-31.13021,0 -46.58333,-5.15104 -46.58333,-5.15104c3.7793,-15.67708 7.83854,-24.63542 8.73438,-27.09896c0.72787,-1.79167 1.42774,-7.39062 37.84896,-7.39062zM32.47396,120.71354c0.72787,-0.08399 1.45573,0 2.23958,0c3.10742,0 9.37826,2.65951 13.4375,4.47917c4.42318,1.98763 9.40625,3.63933 9.40625,6.94271c0,3.05143 -1.5957,4.47917 -7.39062,4.47917h-7.83854c-6.85872,0 -13.66146,-1.00781 -13.66146,-5.375v-5.15104c0,-3.83528 1.6237,-5.09505 3.80729,-5.375zM137.28646,120.71354c3.19141,0 6.04688,0.27995 6.04688,5.375v5.15104c0,4.36719 -6.80274,5.375 -13.66146,5.375h-7.83854c-5.76692,0 -7.39062,-1.42774 -7.39062,-4.47917c0,-3.30338 4.98308,-4.95508 9.40625,-6.94271c4.05924,-1.81966 10.33008,-4.47917 13.4375,-4.47917z"></path></g>

      	<g id="line-msg" fill="#fff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M82.44466,17.91667c-40.87753,0 -75.257,27.05703 -75.257,61.76351c0,30.95249 27.23868,56.07281 62.70833,60.90267c0.81609,0.17714 1.68971,0.46136 2.24658,0.70687c-0.05292,0.30623 0.07305,1.72583 -0.09798,3.02344v0.007c-0.04605,0.27613 -0.80414,4.80171 -0.96582,5.74593l0.007,-0.007c-0.26918,1.55167 -1.13196,4.14446 1.27376,7.78255c1.20286,1.81905 3.91313,3.36389 6.34082,3.40837c2.42769,0.04447 4.46521,-0.75347 6.69775,-1.98063c16.29708,-8.96159 34.00352,-19.074 47.95508,-31.77409c13.95156,-12.70008 24.33447,-28.45499 24.33447,-47.8151c-0.00018,-34.70525 -34.36547,-61.76351 -75.243,-61.76351zM82.44466,28.66667c36.17131,0 64.493,23.53358 64.493,51.01351c0,15.55947 -8.13776,28.31894 -20.82113,39.86458c-12.16217,11.07121 -28.33857,20.53924 -43.90283,29.14258c0.20618,-1.23442 0.46192,-2.77848 0.46192,-2.77848l0.014,-0.08399l0.014,-0.08398c0.26882,-2.01628 1.02091,-5.04132 -0.5599,-8.99333l-0.007,-0.007v-0.007c-1.19537,-2.95553 -3.40865,-4.24022 -5.17904,-5.08805c-1.77038,-0.84784 -3.44583,-1.28395 -4.8361,-1.5817l-0.20996,-0.04199l-0.21696,-0.02799c-31.49144,-4.14324 -53.757,-25.63436 -53.757,-50.31364c0,-27.47869 28.3357,-51.01351 64.507,-51.01351zM65.69678,61.40658c-2.021,0 -3.66732,1.63266 -3.66732,3.63932v27.56787c0,2.01025 1.64273,3.63932 3.66732,3.63932c2.021,0 3.66732,-1.63266 3.66732,-3.63932v-27.56787c0,-2.00667 -1.64274,-3.63932 -3.66732,-3.63932zM78.30843,61.40658c-0.39417,0 -0.78895,0.06355 -1.16878,0.18896c-1.49783,0.49808 -2.50553,1.88444 -2.50553,3.45036v27.56787c0,2.01025 1.64973,3.63932 3.67432,3.63932c2.02817,0 3.67431,-1.63266 3.67431,-3.63932v-17.04883l14.24235,19.23242c0.688,0.91017 1.78579,1.45573 2.93245,1.45573c0.39058,0 0.78195,-0.06355 1.16178,-0.18896c1.505,-0.49092 2.51253,-1.87728 2.51253,-3.45036v-27.57487c0,-2.00667 -1.64274,-3.63232 -3.66732,-3.63232c-2.02458,0 -3.67431,1.62566 -3.67431,3.63232v17.06282l-14.24935,-19.23942c-0.688,-0.91017 -1.78937,-1.45573 -2.93245,-1.45573zM41.08936,61.41357c-2.021,0 -3.66732,1.62566 -3.66732,3.63232v27.57487c0,2.01025 1.64274,3.63932 3.66732,3.63932h13.89941c2.02458,0 3.6639,-1.63965 3.66032,-3.64632c0,-2.00667 -1.63574,-3.63932 -3.66032,-3.63932h-10.2391v-23.92855c0,-2.00667 -1.63573,-3.63232 -3.66032,-3.63232zM111.42627,61.41357c-2.021,0 -3.66732,1.63266 -3.66732,3.63932v0.007v13.76644v0.007v0.007v13.77344c0,2.01025 1.6499,3.63932 3.66732,3.63932h13.89941c2.02458,0 3.67432,-1.63266 3.67432,-3.63932c0,-2.00667 -1.64973,-3.63932 -3.67432,-3.63932h-10.23209v-6.50879h10.23209c2.02817,0 3.67432,-1.63266 3.67432,-3.63932c0,-2.01025 -1.64973,-3.63932 -3.67432,-3.63932v0.014h-10.23209v-6.50879h10.23209c2.02817,0 3.67432,-1.63266 3.67432,-3.63932c0,-2.00667 -1.64973,-3.63932 -3.67432,-3.63932z"></path></g></g>

      	<path id="fb-msg" fill="#fff" d="M86,6.88c-43.52406,0 -79.12,33.01594 -79.12,73.96c0,22.38688 10.77688,42.26094 27.52,55.7925v30.745l5.0525,-2.6875l24.8325,-12.9c6.93375,1.85438 14.14969,3.01 21.715,3.01c43.52406,0 79.12,-33.01594 79.12,-73.96c0,-40.94406 -35.59594,-73.96 -79.12,-73.96zM86,13.76c40.05719,0 72.24,30.12688 72.24,67.08c0,36.95313 -32.18281,67.08 -72.24,67.08c-7.44437,0 -14.64687,-1.075 -21.3925,-3.01l-1.29,-0.3225l-1.1825,0.645l-20.855,10.8575v-22.575l-1.29,-0.9675c-16.04437,-12.34906 -26.23,-30.93312 -26.23,-51.7075c0,-36.95312 32.18281,-67.08 72.24,-67.08zM78.1525,60.9525l-41.3875,43.86l37.195,-20.855l19.8875,21.285l40.85,-44.29l-36.2275,20.3175z"></path>

      	<path id="whatsapp" d="M1113 974q13 0 97.5 44t89.5 53q2 5 2 15 0 33-17 76-16 39-71 65.5t-102 26.5q-57 0-190-62-98-45-170-118t-148-185q-72-107-71-194v-8q3-91 74-158 24-22 52-22 6 0 18 1.5t19 1.5q19 0 26.5 6.5t15.5 27.5q8 20 33 88t25 75q0 21-34.5 57.5t-34.5 46.5q0 7 5 15 34 73 102 137 56 53 151 101 12 7 22 7 15 0 54-48.5t52-48.5zm-203 530q127 0 243.5-50t200.5-134 134-200.5 50-243.5-50-243.5-134-200.5-200.5-134-243.5-50-243.5 50-200.5 134-134 200.5-50 243.5q0 203 120 368l-79 233 242-77q158 104 345 104zm0-1382q153 0 292.5 60t240.5 161 161 240.5 60 292.5-60 292.5-161 240.5-240.5 161-292.5 60q-195 0-365-94l-417 134 136-405q-108-178-108-389 0-153 60-292.5t161-240.5 240.5-161 292.5-60z" fill="#fff"/>

      </defs>
    </svg>
  </div>

</body>
</html>