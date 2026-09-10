<?php require "Require/ex.header.php"; ?>

<body>
    <form method="post" action="pageOeuvre.php">
        <div class="row mb-3 mt-3 mb-3">
            <div class="col-md-4">
                <label for="artistWork">Nom de l'oeuvre :</label>
                <input type="text" name="artistWork" id="artistWork" value="">
            </div>
            <div class="col-md-4">
                <label for="artistName">Nom de l'ariste :</label>
                <input type="text" name="artistName" id="artistName" value="">
            </div>
            <div class="col-md-4">
                <label for="artistRole">Rôle de l'artiste :</label>
                <input type="text" name="artistRole" id="artistRole" value="">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="songTime">Temps de la chanson en second :</label>
                <input type="text" name="songTime" id="songTime" value="">
            </div>
            <div class="col-md-6">
                <label for="songSize">Taille en MB :</label>
                <input type="text" name="songSize" id="songSize" value="">
            </div>
        </div>
        <div class="mb-3">
            <label for="lyrics">Lyrics de la chanson :</label>
            <textarea class="form-control" name="lyrics" id="lyrics" rows="3"></textarea>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="currentDate">Date d'ajout</label>
                <input type="text" name="currentDate" id="currentDate" value="">
            </div>
            <div class="col-md-4">
                <label for="albumCode">Code de l'album :</label>
                <input type="text" name="albumCode" id="albumCode" value="">
            </div>
            <div class="col-md-4">
                <label for="workPrice">Prix de l'oeuvre :</label>
                <input type="text" name="workPrice" id="workPrice" value="">
            </div>
        </div>
        <div class="mb-3">
            <label for="youtubeLink">Lien de la vidéo youtube :</label>
            <input type="text" name="youtubeLink" id="youtubeLink" value="">
            <div class="mb-3 d-flex justify-content-center">
                <input type="submit" value="Enregister">
            </div>
        </div>


    </form>
</body>
<?php require "Require/ex.pied.php"; ?>