# Application Web

## Oh My Count

Oh My Count est une application web qui permet à l'utilisateur de référencer les films, séries et animés qu'il a vu, afin de les noter et de compter le nombre d'heures passé devant l'écran.

## MCD

Un utilisateur possède un pseudo, un mot de passe et une photo
Un utilisateur possède aucun, un ou plusieurs films
Un utilisateur possède aucun, une ou plusieurs séries
Un utilisateur possède aucun, un ou plusieurs animés
Un films possède un titre, une photo et une durée
Une série possède un titre, une photo, une durée et un nombre de saisons
Un animé possède un titre, une photo, une durée et un nombre d'épisodes
Un utilisateur donne une note au film, série ou animé ajouté à son compte

![Dictionnaire de données](/assets/images/Dictionnaire_MCD.png "Dictionnaire de donnée MCD")

id_u? pseudo_u, mdp_u, photo_u
film_id? film_titre, film_photo, film_duree
serie_id? serie_titre, serie_photo, serie_duree, nb_saison
anime_id? anime_titre, anime_photo, anime_duree, nb_episode

![Shéma du MCD](/assets/images/shema_mcd.png "Schéma du MCD")

## MLD

Users(**id_u**, pseudo_u, mdp_u, photo_u)
Films(**film_id**, film_titre, film_duree, film_photo)
Series(**serie_id**, serie_titre, serie_duree, serie_photo, serie_nb_episode)
Animes(**anime_id**, anime_titre, anime_duree, anime_photo, anime_nb_episode)
L_Users_films(**#id_u**, **#film_id**, note)
L_Users_series(**#id_u**, **#serie_id**, note)
L_Users_animes(**#id_u**, **#anime_id**, note)

![Shéma du MLD](/assets/images/MLD.png "Schéma du MLD")
