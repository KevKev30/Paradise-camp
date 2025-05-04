document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.getElementById("toggle-mode");
    const themeLink = document.getElementById("theme-link");
  
    const isDark = localStorage.getItem("mode-sombre") === "true";
  
    if (isDark) {
      themeLink.href = "sombre.css";
    }
  
    toggleButton.addEventListener("click", () => {
      const isCurrentlyDark = themeLink.href.includes("sombre.css");
  
      if (!isCurrentlyDark) {
        themeLink.href = "sombre.css";
        localStorage.setItem("mode-sombre", "true");
      } else {
        themeLink.href = "";
        localStorage.setItem("mode-sombre", "false");
      }
    });
  });
  