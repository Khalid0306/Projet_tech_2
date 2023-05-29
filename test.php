<!DOCTYPE html>
<html>
<head>
  <script>
    function addLink() {
      var linkContainer = document.getElementById("link-container");

      // Créer un nouvel élément lien
      var newLink = document.createElement("a");
      newLink.href = "#";
      newLink.innerText = "Nouveau lien";

      // Ajouter le nouvel élément lien à la suite du lien précédent
      linkContainer.appendChild(newLink);
    }
  </script>
</head>
<body>
  <div id="link-container">
    <a href="#" onclick="addLink()">Ajouter un lien</a>
  </div>
</body>
</html>
