@extends('layouts.frontend.app')
@section('content')
    <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.6433545969026!2d106.65728971459647!3d10.761945462404114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752eee8c448bf1%3A0x93df9d2015fc5d94!2zMTAwMCBWxKluaCBWaeG7hW4sIFBoxrDhu51uZyA3LCBRdeG6rW4gMTEsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1617726013894!5m2!1sen!2s"
            width="600" height="450" style="border:0;" allowfullscreen=""></iframe>
    </div>
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Thông tin</span>
                            <h2>Liên hệ chúng tôi</h2>
                            <p>Như bạn có thể mong đợi về một công ty bắt đầu với tư cách là nhà đầu tư cao cấp, chúng tôi rất chú ý.</p>
                        </div>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt mr-2"></i>Trường đại học FPT, Khu công nghệ cao, Quận 9</p>
                                <a href="tel:0932042076"><i class="fas fa-mobile-alt mr-2"></i> 0925215202</a>
                                <p><i class="fas fa-envelope mr-2"></i>tungptse140843@fpt.edu.vn</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="contact__form">
                        <form action="{{ url('contact') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Hộ và tên" name="name" value="{{ old('name') }}" autocomplete="off">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="off">
                                </div>
                                <div class="col-lg-12 send-message">
                                    <textarea placeholder="Nội dung" name="message">{{ old('message') }}</textarea>
                                    <button type="submit" class="site-btn">Liên hệ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
