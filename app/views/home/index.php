<div class="container">
    <div class="dashboard">
        <div class="header">
            <span class="header__status">Đang phát:</span>
            <span class="header__name-song">Unknown</span>
        </div>
        <div class="cd">
            <div class="cd__thumb" style="background-image: url(<?=BASE_URL .'/assets/img/no-image.png'?>);"></div>
        </div>
        <div class="duration">
            <span class="duration_start">0:00</span>
            <input type="range" class="duration-bar" step="1" value="0" max="100">
            <span class="duration_end">0:00</span>
        </div>
        
        <div class="control">
            <div class="btn btn-round btn-repeat">
                <svg class="controll__img" xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512">
                    <path d="M463.5 224H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1c-87.5 87.5-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5z" />
                </svg>
            </div>
            <div class="btn btn-round btn-previous">
                <svg class="controll__img" xmlns="http://www.w3.org/2000/svg" height="18" width="12" viewBox="0 0 320 512">
                    <path d="M267.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160L64 241V96c0-17.7-14.3-32-32-32S0 78.3 0 96V416c0 17.7 14.3 32 32 32s32-14.3 32-32V271l11.5 9.6 192 160z" />
                </svg>
            </div>
            <div class="btn btn-round btn-pause">
                <svg xmlns="http://www.w3.org/2000/svg" height="18" width="12" viewBox="0 0 320 512">
                    <path fill="#ffffff" d="M48 64C21.5 64 0 85.5 0 112V400c0 26.5 21.5 48 48 48H80c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zm192 0c-26.5 0-48 21.5-48 48V400c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H240z" />
                    </svg>
            </div>
            <div class="btn btn-round btn-play">
                <svg xmlns="http://www.w3.org/2000/svg" height="18" width="14" viewBox="0 0 384 512">
                    <path fill="#ffffff" d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z" />
                </svg>
            </div>
            <div class="btn btn-round btn-next">
                <svg class="controll__img" xmlns="http://www.w3.org/2000/svg" height="18" width="12" viewBox="0 0 320 512">
                    <path d="M52.5 440.6c-9.5 7.9-22.8 9.7-34.1 4.4S0 428.4 0 416V96C0 83.6 7.2 72.3 18.4 67s24.5-3.6 34.1 4.4l192 160L256 241V96c0-17.7 14.3-32 32-32s32 14.3 32 32V416c0 17.7-14.3 32-32 32s-32-14.3-32-32V271l-11.5 9.6-192 160z" />
                </svg>
            </div>
            <div class="btn btn-round btn-shuffle">
                <svg class="controll__img" xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512">
                    <path d="M403.8 34.4c12-5 25.7-2.2 34.9 6.9l64 64c6 6 9.4 14.1 9.4 22.6s-3.4 16.6-9.4 22.6l-64 64c-9.2 9.2-22.9 11.9-34.9 6.9s-19.8-16.6-19.8-29.6V160H352c-10.1 0-19.6 4.7-25.6 12.8L284 229.3 244 176l31.2-41.6C293.3 110.2 321.8 96 352 96h32V64c0-12.9 7.8-24.6 19.8-29.6zM164 282.7L204 336l-31.2 41.6C154.7 401.8 126.2 416 96 416H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H96c10.1 0 19.6-4.7 25.6-12.8L164 282.7zm274.6 188c-9.2 9.2-22.9 11.9-34.9 6.9s-19.8-16.6-19.8-29.6V416H352c-30.2 0-58.7-14.2-76.8-38.4L121.6 172.8c-6-8.1-15.5-12.8-25.6-12.8H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H96c30.2 0 58.7 14.2 76.8 38.4L326.4 339.2c6 8.1 15.5 12.8 25.6 12.8h32V320c0-12.9 7.8-24.6 19.8-29.6s25.7-2.2 34.9 6.9l64 64c6 6 9.4 14.1 9.4 22.6s-3.4 16.6-9.4 22.6l-64 64z" />
                </svg>
            </div>
        </div>
        <audio id = "song" src=""></audio>
        <div class="up-next">Up next</div>
    </div>
    <ul class="playlist">
        
    </ul>
    <label class="timer timer--disabled" for="timer-checkbox">
        <div class="time-stamp">
            <span class="timer-minutes">00</span>
            <span>:</span>
            <span class="timer-seconds">00</span>
        </div>
        <div class="timer-icon">
        <svg xmlns="http://www.w3.org/2000/svg" height="26" width="26" viewBox="0 0 512 512">
            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path class="timer-icon-svg" fill="#ffffff" d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
        </svg>
        </div>
    </label>

    <input type="checkbox" class="timer-checkbox" id="timer-checkbox">
    <div class="modal">
        <div class="modal__overlay">
        </div>
        <div class="modal__body">
            <label class="timer-exit" for="timer-checkbox">
                <svg xmlns="http://www.w3.org/2000/svg" height="14" width="14" viewBox="0 0 512 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path fill="#ffffff" d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                </svg>
            </label>
            <div class="timer-container">
                    <div class="timer_header">
                        Hẹn giờ tắt nhạc
                    </div>
                    <div class="timer-wrapper">
                        <div class="timer-input-block">
                            <input class="timer-input" type="text" value="00">
                        </div>
                        :
                        <div class="timer-input-block">
                            <input class="timer-input" type="text" value="00">
                        </div>
                    </div>
                    <label for="timer-checkbox" class="btn btn--primary btn-timer" id="timer-btn">OK</label>
                </div>
        </div>
    </div>
</div>

<script src="<?=BASE_URL .'/assets/js/home.js'?>"></script>