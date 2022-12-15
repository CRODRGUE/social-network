
Pour mener à bien le projet, j'ai opté pour une architecture MVC à fin de rendre la phase de production la plus simple et rapide. 
	Dossier API => modeles et controleurs
	Dossier templates => les vues du projet 
J'ai séparé l'arborescence en deux parties à fin de mettre d'un coter la vue, puis la gestion des données et des demandes de l'autre.

A noter toutes les demandes du cahier des charges ont été realisées et mise en oeuvre
	
Pour lancer le projet 

	- Il faut lancer Docker
	- Ouvrir un terminal à la racine du projet (où se situe le fichier "docker-compose.yml")
	- Exécuter la commande -> docker-compose up

Pour ajouter la BDD (au premier lancement seulement)

	-Il faut accéder au container du service mysql, pour identifier le nom du container utilisé dans un autre terminal 
		la commande suivante -> docker ps -a (dans le nom il y a mysql-1)
	-Ensuite il faut exécuter la commande suivante pour accéder au terminal bash du container 
		-> docker exec -it NOM bash
	-Maintenant il faut se connecter à la base de données avec la commande suivante (une fois connecté il y a "mysql>")
		-> mysql -uroot -ptest
	-Pour finir il faut simplement copier/coller le contenu du fichier "script BDD.sql" dans le terminal

	==> http://localhost/modulePHP/projet_php/index <==
	
Comptes de tests
	//lien avec Gil
	mail -> cyril@test.ts
	pseudo -> cyril
	pwd -> azerty123

	// lien avec cyril et jules
	mail -> gil@test.ts
	pseudo -> Gil
	pwd -> azerty123

	// lien avec Gil
	mail -> jules@test.ts
	pseudo -> Jules
	pwd -> azerty123
	
	//aucun lien d'amitié
	mail -> CompteVide@test.ts
	pseudo -> CompteVide
	pwd -> azerty123
	
Les mail non caseSensitive / Les pseudo sont caseSensitive