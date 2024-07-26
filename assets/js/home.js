var gateway = 'ws://' + window.location.hostname + ':8080';
var conn;

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const playlist = $('.playlist');
const cd = $('.cd');
const cdThumb = $('.cd__thumb');
const dashboard = $('.dashboard');
const audio = $('#song');
const playBtn = $('.btn.btn-play');
const pauseBtn = $('.btn.btn-pause');
const nextBtn = $('.btn.btn-next');
const previousBtn = $('.btn.btn-previous');
const repeatBtn = $('.btn.btn-repeat');
const shuffleBtn = $('.btn.btn-shuffle');
const headerNameSong = $('.header__name-song');
const timerElement = $('.timer');
const timerBtn = $('#timer-btn');
const timerInputs = $$('.timer-input');
const timerMinutes = $('.timer-minutes');
const timerSeconds = $('.timer-seconds');

heightDashboard = dashboard.offsetHeight;
playlist.style.marginTop = heightDashboard + 15 + 'px';

const cdWidth = cd.offsetWidth;
const cd_rotate = cd.animate([{
    transform: "rotate(360deg)"
}], {
    duration: 12000,
    iterations: Infinity
});
cd_rotate.pause();

const app = {
    isPlaying: false,
    isRepeat: false,
    isShuffle: false,
    audio: [],
    curAudioId: null,
    timer: 0,

    start: function() {
        this.connectWS();
        this.handleEvents();
    },
    renderPlaylist: function() {
        if (this.audio === null) {
            return;
        }
        const htmls = this.audio.map((audio, index) => {
            return `
                <li class="playlist-item ${index === this.curAudioId ? "playlist-item--active" : ""}" data-index="${index}">
                    <div class="playlist__thumb" style="background-image: url(<?=BASE_URL .'/assets/img/no-image.png'?>);"></div>
                    <div class="playlist__info">
                        <span class="playlist__name">${audio}</span>
                        <span class="playlist__author"></span>
                    </div>
                    <div class="playlist-item__ellipsis">
                      ${index == this.curAudioId ? 
                        `
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 448 512">
                            <path fill="#ffffff" d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z" />
                        </svg>
                        `
                        : 
                        `
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 448 512">
                            <path d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z" />
                        </svg>
                        `}
                        
                    </div>
                </li>
            `;
        })
        playlist.innerHTML = htmls.join('\n');
    },
    //handle events
    handleEvents: function() {
        //scroll event
        document.addEventListener("scroll", () => {
            const scroll = window.scrollY || document.documentElement.scrollTop;
            cd.style.width = (((cdWidth - scroll) / cdWidth * 50) > 0 ? ((cdWidth - scroll) / cdWidth * 50) : 0) + '%';
            cd.style.opacity = (((cdWidth - scroll) / cdWidth) > 0 ? ((cdWidth - scroll) / cdWidth) : 0);
        });

        //play btn event
        playBtn.addEventListener("click", () => {
            if (this.isPlaying) {
                this.sendRequest('pause');
            } else {
                if (this.curAudioId !== null) {
                    this.sendRequest('play ' + this.curAudioId);
                }
            }
        });

        //pause btn event
        pauseBtn.addEventListener("click", () => {
            if (this.isPlaying) {
                this.sendRequest('pause');
            } else {
                this.sendRequest('play ' + this.curAudioId);
            }
        });

        //next btn event
        nextBtn.addEventListener("click", () => {
            this.sendRequest('next');
        })

        //previous btn event
        previousBtn.addEventListener("click", () => {
            this.sendRequest('previous');
        })

        // repeat btn event
        repeatBtn.addEventListener("click", () => {
            if (this.isRepeat) {
                this.sendRequest('cancel repeat');
            } else {
                this.sendRequest('repeat');
            }
        })

        // shuffle btn event
        shuffleBtn.addEventListener("click", () => {
            if (this.isShuffle) {
                this.sendRequest('cancel shuffle');
            } else {
                this.sendRequest('shuffle');
            }
        })

        //timer
        timerBtn.addEventListener('click', () => {
            m = timerInputs[0].value;
            s = timerInputs[1].value;
            num_regex = /^[0-9]+$/;

            if (num_regex.test(m) && num_regex.test(s)) {
                m = parseInt(m, 10);
                s = parseInt(s, 10);
                time = getTime() + m*60 + s;
                time = time.toString();
                
                console.log(time);
                this.sendRequest('timer ' + time);
            }

            timerInputs[0].value = '00';
            timerInputs[1].value = '00';
        })


        //handle playlist click event
        playlist.addEventListener("click", (e) => {
            const item = e.target.closest(".playlist-item:not(.playlist-item--active)");
            if (item) {
                const ind = parseInt(item.dataset.index);
                if (ind != null) {
                    this.sendRequest('play ' + ind);
                }
            }
        })

    },
    connectWS: function () {
        conn = new WebSocket(gateway);

        conn.onopen = () => {
            this.sendRequest("join");
            Swal.fire({
                timer: 2000,
                title: "Đã kết nối",
                timerProgressBar: true,
            });
            console.log("Connection established!");
        };

        conn.onclose = () => {
            Swal.fire({
                title: "Mất kết nối với server"
            });
            setTimeout(() => {
                this.connectWS();
            }, 2000);
        }

        conn.onmessage = (e) => {
            data = JSON.parse(e.data);
            console.log(data);

            if (data['sender'] == 'server') {
                if (data['action'] == 'update') {
                    data = data['data'];

                    this.isPlaying = data.hasOwnProperty('isPlaying') ? data['isPlaying'] : this.isPlaying;
                    this.isRepeat = data.hasOwnProperty('isRepeat') ? data['isRepeat'] : this.isRepeat;
                    this.isShuffle = data.hasOwnProperty('isShuffle') ? data['isShuffle'] : this.isShuffle;
                    this.audio = data.hasOwnProperty('audio') ? data['audio'] : this.audio;
                    this.curAudioId = data.hasOwnProperty('curAudioId') ? data['curAudioId'] : this.curAudioId;
                    this.timer = data.hasOwnProperty('timer') ? data['timer'] : this.timer;
                    
                    if (this.isPlaying === true) {
                        cd_rotate.play();
                        playBtn.style.display = 'none';
                        pauseBtn.style.display = 'flex';
                        headerNameSong.innerText = this.audio[this.curAudioId];
                    } else {
                        cd_rotate.pause();
                        headerNameSong.innerText = 'Unknown';
                        playBtn.style.display = 'flex';
                        pauseBtn.style.display = 'none';
                    }

                    if (this.isRepeat === true) {
                        repeatBtn.classList.add('btn--active');
                    } else {
                        repeatBtn.classList.remove('btn--active');
                    }

                    if (this.isShuffle === true) {
                        shuffleBtn.classList.add('btn--active');
                    } else {
                        shuffleBtn.classList.remove('btn--active');
                    }

                    if (getTime() < this.timer) {
                        timerElement.classList.remove('timer--disabled');
                        countDown(this.timer, renderTimer);
                    } else {
                        timerElement.classList.add('timer--disabled');
                    }

                    this.renderPlaylist();
                } else return;
                
            }
        };
    },
    sendRequest: function(action) {
        payload = this.payload(action);
        conn.send(payload);
    },
    payload: function (action = "get") {
        json = {
            "action": action,
            "sender": 'app',
        }
        return JSON.stringify(json);
    },
    scrollToActiveSong: function() {
        setTimeout(() => {
            $(".playlist-item--active").scrollIntoView({
                behavior: "smooth",
                block: "nearest"
            });
        }, 300);
    },
};

app.start();

function renderTimer(minutes, seconds) {
    timerMinutes.innerText = minutes < 10 ? '0' + minutes.toString() : minutes;
    timerSeconds.innerText = seconds < 10 ? '0' + seconds.toString() : seconds;
}

function countDown(time, callback) {
    function updateCountdown() { 
        let currentTime = getTime();
        let remainingTime = Math.max(0, time - currentTime);
        
        let seconds = remainingTime % 60;
        let minutes = Math.floor(remainingTime / 60);
        callback(minutes, seconds);

        if (remainingTime > 0) {
            requestAnimationFrame(updateCountdown);
        } else {
            callback(0, 0);
        }
    }

    updateCountdown();
}

function getTime() {
    return Math.floor(Date.now() / 1000);
}
