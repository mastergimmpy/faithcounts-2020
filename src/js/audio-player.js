// this is the default function that is called whenever the page loads but also used
// by the overlay.js function to wire up the podcast in the popup. In that case it
// will pass in an html element that it wants to look in rather than the whole doc.
export default searchIn => {
  const root = searchIn || document;
  const players = root.querySelectorAll(".audio-player");
  if (players.length) {
    let currPlaying = false;
    players.forEach(player => {
      // get the play indicator and its background
      const playIndicator = player.querySelector(".play-indicator");
      const playIndicatorBg = player.querySelector(".play-indicator-bg");

      // need to wire up some audio events first
      const audio = player.querySelector("audio");
      audio.addEventListener("loadedmetadata", e => {
        player.querySelector(".duration").innerHTML = secondsAsTime(
          audio.duration
        );
        player.querySelector(".current-time").innerHTML = secondsAsTime(
          audio.currentTime
        );
      });
      audio.addEventListener("canplaythrough", e => {
        player.querySelector(".duration").innerHTML = secondsAsTime(
          audio.duration
        );
        player.querySelector(".current-time").innerHTML = secondsAsTime(
          audio.currentTime
        );
      });
      audio.addEventListener("timeupdate", e => {
        const playPct = (audio.currentTime / audio.duration) * 100;
        playIndicator.style.width = playPct + "%";
        if (audio.currentTime === audio.duration) {
          player.classList.remove("playing");
          currPlaying = false;
        }
        player.querySelector(".current-time").innerHTML = secondsAsTime(
          audio.currentTime
        );
      });
      player.querySelector(".play-button").addEventListener("click", e => {
        if (player.classList.contains("playing")) {
          player.querySelector("audio").pause();
          player.classList.remove("playing");
          currPlaying = false;
        } else {
          player.querySelector("audio").play();
          player.classList.add("playing");
          if (currPlaying) {
            currPlaying.classList.remove("playing");
            currPlaying.querySelector("audio").pause();
          }
          currPlaying = player;
        }
      });
      playIndicatorBg.addEventListener("click", e => {
        const rect = playIndicatorBg.getBoundingClientRect();
        const pct = (e.clientX - rect.left) / rect.width;
        audio.currentTime = audio.duration * pct;
        playIndicator.style.width = pct * 100 + "%";
        player.querySelector(".current-time").innerHTML = secondsAsTime(
          audio.currentTime
        );
      });
      player.querySelector(".rewind").addEventListener("click", e => {
        if (audio.currentTime < 10) {
          audio.currentTime = 0;
        } else {
          audio.currentTime = audio.currentTime - 10;
        }
        player.querySelector(".current-time").innerHTML = secondsAsTime(
          audio.currentTime
        );
      });
      player.querySelector(".fast-forward").addEventListener("click", e => {
        if (audio.duration - audio.currentTime < 10) {
          audio.currentTime = audio.duration - 1;
        } else {
          audio.currentTime = audio.currentTime + 10;
        }
        player.querySelector(".current-time").innerHTML = secondsAsTime(
          audio.currentTime
        );
      });
    });
  }
  document.querySelectorAll(".transcript-btn").forEach(btn => {
    const transcript = btn.nextElementSibling;
    btn.addEventListener("click", e => {
      if (btn.classList.contains("open")) {
        btn.classList.remove("open");
        transcript.classList.remove("open");
      } else {
        btn.classList.add("open");
        transcript.classList.add("open");
      }
    });
  });
  // Handles the transcript opening for audio at the bottom of portrait pages
  document.querySelectorAll("div.transcript-toggle").forEach(el => {
    let removeId = false;
    if (!el.id) {
      el.id = "temp-id-sp";
      removeId = true;
    }
    const transcriptSec = document.querySelector(
      "div#" + el.id + " + div.transcript"
    );
    if (transcriptSec) {
      el.addEventListener("click", e => {
        if (transcriptSec.classList.contains("open")) {
          transcriptSec.classList.remove("open");
          el.classList.remove("open");
        } else {
          transcriptSec.classList.add("open");
          el.classList.add("open");
        }
      });
    }
    if (removeId) {
      el.removeAttribute("id");
    }
  });
};

const secondsAsTime = rawSeconds => {
  let seconds = Math.round(rawSeconds);
  let hrs = Math.floor(seconds / 3600);
  let mns = Math.floor((seconds % 3600) / 60);
  let scs = seconds % 60;
  let str = "";
  if (hrs > 0) {
    str += hrs + ":";
  }
  if (mns > 0) {
    if (str !== "" && mns < 10) {
      str += "0";
    }
    str += mns + ":";
  } else {
    str += "0:";
  }
  if (scs < 10) {
    str += "0";
  }
  str += scs;
  return str;
};
