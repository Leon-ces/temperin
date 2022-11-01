function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        document.getElementById("demo").innerHTML =
        this.responseText;
    };
    xhttp.open("GET", "text.txt", true);
    xhttp.send();
  }