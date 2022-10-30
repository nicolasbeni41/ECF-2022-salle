# ECF-2022-salle de sport


## Présentation de l'examen

**Activité** – *Type 1* : Développer la partie front-end d’une application web ou
web mobile en intégrant les recommandations de sécurité
- Maquetter une application.
- Réaliser une interface utilisateur web statique et adaptable.
- Développer une interface utilisateur web dynamique.
- Réaliser une interface utilisateur avec une solution de gestion de contenu ou e-commerce.

**Activité** – *Type 2* : Développer la partie back-end d’une application web ou
web mobile en intégrant les recommandations de sécurité
- Créer une base de données.
- Développer les composants d’accès aux données.
- Développer la partie back-end d’une application web ou web mobile.
- Élaborer et mettre en œuvre des composants dans une application de gestion de contenu ou e-commerce.

Avec les informations du cahier des charges et vos propres connaissances, vous
allez réaliser la partie Front et Back du site web ainsi qu’un maquettage complet.

**Les objectifs**: Réaliser une interface web sécurisée et son administration
- Développer l’interface web présentée ci-dessous ainsi que son interface d’administration.
- Élaborer un dossier d’analyse des besoins qui documente, entre autres, les choix des technologies, UML (Use case, Sequence et Classe), les choix d’architecture logicielle et de configuration, les bonnes pratiques de sécurité implémentées, etc.
- Élaborer un document spécifique sur les mesures et bonnes pratiques de sécurité mises en place et la justification de chacune d’entre elles ainsi que leurs tests unitaires.

## Livrables

Le code de l’application sur un dépôt Github. Le dépôt doit également contenir un guide de déploiement et un manuel d’utilisation au format Readme.md pour l’administrateur. Le document « questions et réflexions » rempli et exporté au format pdf.
Une version en ligne de l’application pour la présentation déployée grâce à Heroku. Pour connaître la marche à suivre, n’hésitez pas à reprendre votre module « Déployer son application web avec Heroku ».
Un lien vers, par exemple, un trello (ou autre système de gestion des tâches).

**Contraintes techniques**:
- Les contraintes techniques sont liées au serveur et à sa configuration, aussi les technologies choisies pour développer le projet respectent l’architecture du serveur.
- Les contraintes de temps vont nécessiter une épuration du design de façon à offrir une vraie expérience utilisateur et un contenu simplifié et clair afin d’accélérer la phase de développement.

**Les annexes**:

Vous retrouverez dans les annexes les éléments suivants qui vous serviront
d’exemples. Vous pouvez vous en servir ou bien les adapter à vos propres
compétences de développeur :
- Analyses des besoins
- Quelques diagrammes UML
- Un début de charte graphique
- Un wireframe
- FAQ

---

## LE PROJET API SALLE DE SPORT

**Objectifs**:

L’objectif du projet est de mener une étude (Analyse des besoins) et développer l’application web présentée ci-dessous. Il convient également d’élaborer un dossier d’architecture web qui documente entre autres les choix des technologies, les choix d’architecture web et de configuration, les bonnes pratiques de sécurité́ implémentées, etc.
Il est également demandé d’élaborer un document spécifique sur les mesures et bonnes pratiques de sécurité́ mises en place et la justification de chacune d’entre elles. Les bases de données et tout autre composant nécessaire pour faire fonctionner le projet sont également accompagnés d’un manuel de configuration et d’utilisation.

1. **Exigences**

    Notre client est une grande marque de salle de sport et souhaite la création d’une interface simple à destination de ses équipes qui gèrent les droits d'accès à ses applications web de ses franchisés et partenaires qui possèdent des salles de sport. Ainsi, lorsqu'une salle de sport ouvre et prend la franchise de cette marque, on lui donne accès à un outil de gestion en ligne.
    En fonction de ce qu’il va reverser à la marque et de son contrat, il a droit à des options ou modules supplémentaires. Par exemple, un onglet “faire son mailing” ou encore "gérer le planning équipe" ou bien “promotion de la salle" ou encore “vendre des boissons” peut être
    activé ou désactivé.
    Le projet a donc pour but la création et la construction d’une interface cohérente et ergonomique afin d’aider leurs équipes à ouvrir des accès aux modules de leur API auprès des franchisés/partenaires.
    L’interface devra permettre de donner de la visibilité́ sur les partenaires/franchisés utilisant l’API et quels modules sont accessibles par ces partenaires. Elle doit faciliter l'ajout, la modification ou la suppression des permissions aux modules de chaque partenaire/franchisé.
    
2. **Cible**

    L’interface sera utilisée par l’équipe technique de développement de la marque.

3. **Périmètre du projet**

    L’interface devra avoir un design responsive et être rédigée en Français. Liste des fonctionnalités :
        - Afficher la liste des partenaires actifs,
        - Afficher la liste des partenaires désactivés,
        - Consulter les différentes structures des partenaires (activées et désactivées),
        - Modifier les permissions des structures,
        - Ajouter une nouvelle structure à un partenaire avec des permissions prédéfinies entre un technicien du client et le partenaire concerné,
        - Envoyer automatiquement un email après l’ajout d’une structure au partenaire concerné,
        - Possibilité de confirmation d’accès aux données de la structure par le partenaire,
        - Afficher le contenu du mail dans un nouvel onglet.

    Pour finir, elle devra être intégrée à l’outil interne et la base de données existante. Vous êtes donc libre d’adapter d'éventuelles données entrantes.

---
## Utilisation en local

### Installation du projet

Pour installer du projet sur une machine, vous devez le cloner depuis le dépôt Github en utilisant la commande
<br/>
  `https://github.com/nicolasbeni41/ECF-2022-salle.git`
<br/>
  Rendez vous dans le dossier dans lequel vous avez cloner le projet en tapant
<br/>
  `cd ECF-2022-salle` 
<br/>
  Installer toutes les dépendances 
<br/> 
 `composer install`  
<br/>
  Créez la base de données avec
<br/>
  `php bin/console doctrine:database:create`  
<br/>
  Faites la migration avec 
<br/>
 `php bin/console make:migration`  
 puis `php bin/console doctrine:migrations:migrate`  
<br/>
  Lancez le serveur Symfony 
<br/>
  `symfony serve` 

### Création d'un profil administrateur
Pour tester l'application il est nécessaire de créer un utilisateur pour cela rendez-vous à l'adresse https://127.0.0.1:8000/register et remplissez le formulaire.

## Annexes du projet 
Les diagrammes de l'application
<br/>
  `https://github.com/nicolasbeni41/ECF-2022-salle/tree/dev/annexes/Diagrammes`
<br/>
  Rendez vous dans le dossier maquettage pour le wireframe mobile et desktop
<br/>
  `https://github.com/nicolasbeni41/ECF-2022-salle/tree/dev/annexes/Maquettage` 
<br/>

