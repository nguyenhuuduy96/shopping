@extends('layouts.home.main')
@section('title','Liên hệ')

@section('content')


	<!-- Title page -->
	<section class="bg-img1 txt-center m-top-80 p-lr-15 p-tb-92" style="background-image: url({{asset('home/images/bg-01.jpg')}});">
		<h2 class="ltext-105 cl0 txt-center">
			Contact
		</h2>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
               
                <form action="javascript:void(0)" method="post" id="SubmitContact">
                        @csrf
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Send Us A Message
							<span class="text-success success" ></span>
					
				
						</h4>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name" id="name" placeholder="Your name ">
							<img class="how-pos4 pointer-none" src="{{asset('home/images/icons/avatar.png')}}" alt="ICON" width="22" height="18">
						</div>
						<span class="text-danger error_name"></span>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" id="email" placeholder="Your Email Address">
							<img class="how-pos4 pointer-none" src="{{asset('home/images/icons/icon-email.png')}}" alt="ICON">
						</div>
                        <span class="text-danger error_email"></span>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="hotline" id="hotline" placeholder="hotline">
							<img class="how-pos4 pointer-none" src="{{asset('home/images/icons/hotline.png')}}" alt="ICON" width="22" height="18">
						</div>
						<span class="text-danger error_hotline"></span>
						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="content" id="content" placeholder="How Can We Help?"></textarea>
						</div>
						<span class="text-danger error_content"></span>
						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Submit
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Địa chỉ: 
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Lets Talk
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Sale Support
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								contact@example.com
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
	
	
	<!-- Map -->
	<div class="map col-sm-12">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21066.134308996836!2d105.75286817121368!3d21.03262174933284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455ce91f48d45%3A0xcd2b2aeba8acce9b!2zVOG7lSBo4bujcCB0w7JhIG5ow6AgRlBUIFBvbHl0ZWNobmlj!5e0!3m2!1svi!2s!4v1578898902212!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
	</div>
@endsection
@section('js')
    <script  >
        let SubmitContact = document.getElementById('SubmitContact');
        SubmitContact.addEventListener('submit',function(){
            let name = $('#name').val();
            let email = $('#email').val();
            let hotline = $('#hotline').val();
            let content = $('#content').val();
            if(name == ""){
                $('.error_name').html('vui lòng nhập!');
                $('.error_name').css('display','block')
                return false;
            }else{
                $('.error_name').css('display','none')
            }
            if(email == ""){
                $('.error_email').html('vui lòng nhập!');
                $('.error_email').css('display','block')
                return false;
            }else{
                $('.error_email').css('display','none')
            }
            if(hotline == ""){
                $('.error_hotline').html('vui lòng nhập!');
                $('.error_hotline').css('display','block')
                return false;
            }else{
                $('.error_hotline').css('display','none')
            }
            if(content == ""){
                $('.error_content').html('vui lòng nhập!');
                $('.error_content').css('display','block')
                return false;
            }else{
                $('.error_content').css('display','none')
            }
            // return false;
            $.ajax({
                url:"../send-contact",
                type:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                    $('.success').html('success');
                    SubmitContact.reset();
                }
            });
        })
    </script>    
@endsection