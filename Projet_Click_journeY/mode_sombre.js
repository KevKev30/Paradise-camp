function setCookie(nom, valeur, jours) {
  const expires = new Date(Date.now() + jours * 864e5).toUTCString();
  document.cookie = nom + "=" + encodeURIComponent(valeur) + "; expires=" + expires + "; path=/";
}

function getCookie(nom) {
  return document.cookie.split("; ").reduce((r, v) => {
    const parts = v.split("=");
    return parts[0] === nom ? decodeURIComponent(parts[1]) : r
  }, "");
}

document.addEventListener("DOMContentLoaded", () => {
  const toggleButton = document.getElementById("toggle-mode");
  const themeLink = document.getElementById("theme-link");


  const mode = getCookie("mode-sombre");

  if (mode === "true") {
    themeLink.href = "sombre.css";
  } else {
    themeLink.href = "style1.css"; 
  }

  toggleButton.addEventListener("click", () => {
    const isCurrentlyDark = themeLink.href.includes("sombre.css");

    if (!isCurrentlyDark) {
      themeLink.href = "sombre.css";
      setCookie("mode-sombre", "true", 30);
    } else {
      themeLink.href = "style1.css";
      setCookie("mode-sombre", "false", 30);
    }
  });
});