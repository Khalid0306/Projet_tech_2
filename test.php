






<form action="affichage.php " method="post"    enctype="multipart/form-data"   >

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="" required /><br/><br>


        
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" value="" required /><br/><br/>

        <label for="password">Nouveau mot de passe :</label>
        <input type="password" name="password" id="password" /><br/><br/>

        <label for="sexe">Sexe :</label>
        <select name="sexe" id="sexe" required>
            <option value="">Sélectionnez</option>
            <option value=  ""  >Masculin</option>
            <option value=     ""      >Féminin</option>
        </select><br/><br/>

        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" value="  " required /><br/><br/>

        <label for="pays">Pays :</label>
        <input type="text" name="pays" id="pays" value="    " required /><br/><br/>

        <label for="avatar">Avatar :</label>
        <input type="file" name="avatar" id="avatar" /><br/><br/>

        <input type="submit" name="update" value="Mettre à jour" />
    </form>
