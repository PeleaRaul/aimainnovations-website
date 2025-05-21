<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");
.wrapper {
  position: fixed;
  bottom: 50px;
  right: -370px;
  max-width: 345px;
  width: 100%;
  background: #fff;
  border-radius: 8px;
  padding: 15px 25px 22px;
  transition: right 0.3s ease;
  box-shadow: 0 20px 20px rgba(0, 0, 0, 0.3);
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
.wrapper.show {
  right: 20px;
}
.wrapper header {
  display: flex;
  align-items: center;
  column-gap: 15px;
}
header i {
  color: #4070f4;
  font-size: 32px;
}
header h2 {
  color: #4070f4;
  font-weight: 500;
}
.wrapper .data {
  margin-top: 16px;
}
.wrapper .data p {
  color: #333;
  font-size: 16px;
}
.data p a {
  color: #4070f4;
  text-decoration: none;
}
.data p a:hover {
  text-decoration: underline;
}
.wrapper .buttons {
  margin-top: 16px;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.buttons .button {
  border: none;
  color: #fff;
  padding: 8px 0;
  border-radius: 4px;
  background: #4070f4;
  cursor: pointer;
  width: calc(100% / 2 - 10px);
  transition: all 0.2s ease;
}
.buttons #acceptBtn:hover {
  background-color: #034bf1;
}
#declineBtn {
  border: 2px solid #4070f4;
  background-color: #fff;
  color: #4070f4;
}
#declineBtn:hover {
  background-color: #4070f4;
  color: #fff;
}
</style>
<div class="wrapper" style="z-index: 1000;">
    <header>
        <i class="bx bx-cookie"></i>
        <h2>Cookies Consent</h2>
    </header>

    <div class="data">
        <p>This website use cookies to help you have a superior and more relevant browsing experience on the website. <a href="../cookies.php"> Read more...</a></p>
        <span style="display:none;">Created by Pelea Raul-Daniel</span>
    </div>

    <div class="buttons">
        <button class="button" id="acceptBtn">Accept</button>
        <button class="button" id="declineBtn">Decline</button>
    </div>
</div>
<script>
const cookieBox = document.querySelector(".wrapper"),
buttons = document.querySelectorAll(".button");

const executeCodes = () => {
  if (document.cookie.includes("PeleaRaulDanielv4")) return;
  cookieBox.classList.add("show");

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      cookieBox.classList.remove("show");
      if (button.id == "acceptBtn") {
        document.cookie = "cookieBy= PeleaRaulDanielv4; max-age=" + 60 * 60 * 24 * 30;
      } else if (button.id == "declineBtn") {
            function deleteAllCookies() {
            const cookies = document.cookie.split(";");

            for (let cookie of cookies) {
                const eqPos = cookie.indexOf("=");
                const name = eqPos > -1 ? cookie.substr(0, eqPos).trim() : cookie.trim();
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            }
        }

        deleteAllCookies();
        }
    });
  });
};

window.addEventListener("load", executeCodes);
</script>