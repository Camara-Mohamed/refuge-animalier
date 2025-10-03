# Refuge animalier

## 1. La réalité en question

Imaginez la vie quotidienne dans un refuge animalier.

Chaque matin, les bénévoles ouvrent les chenils, vérifient l’état de santé des animaux et accueillent les premiers visiteurs. Des familles viennent voir les chiens, les chats, parfois des NAC (nouveaux animaux de compagnie). Les bénévoles racontent l’histoire de chaque pensionnaire : pourquoi il est là, quel est son caractère, s’il est stérilisé ou vacciné.

Dans l’après-midi, une famille tombe amoureuse de Luna, une chienne de deux ans. Ils remplissent un formulaire de demande d’adoption. Les bénévoles notent leurs coordonnées, et un responsable se charge ensuite de vérifier si la famille répond aux conditions (maison adaptée, budget vétérinaire, etc.). Après quelques jours, le refuge décide d’accepter la demande et contacte la famille pour planifier l’adoption.

En parallèle, l’administrateur du refuge tient à jour une base de données interne : chaque animal a une fiche avec son statut (disponible, réservé, adopté, en soins), ses informations de santé et sa photo. Les bénévoles peuvent mettre à jour ces fiches facilement.

Le refuge reçoit aussi de nombreuses demandes d’adoption par email. Il devient vite difficile de suivre qui a répondu, et pour quel animal. Une plateforme centralisée permettrait de :

- montrer au public les animaux disponibles,
- recueillir les demandes d’adoption via un formulaire,
- suivre le traitement des demandes,
- notifier les familles par email lorsqu’une demande est acceptée ou refusée,
- permettre à l’équipe du refuge de collaborer.

Cette plateforme, si elle est bien conçue, pourrait être utilisée par n’importe quel refuge animalier, qu’il soit petit (10 animaux) ou grand (plusieurs centaines).

## 2. Besoins fonctionnels
### 2.1. Volet public

Accueil avec présentation du refuge.
Catalogue des animaux (photo, nom, espèce, âge, sexe, statut).
Fiche détaillée d’un animal (description, historique, conditions d’adoption).
Filtrage et recherche (espèce, statut, nom).
Formulaire de demande d’adoption (coordonnées du demandeur, message).

### 2.2. Volet administratif
Gestion des animaux : ajout, modification, archivage, photo.
Gestion des demandes d’adoption : suivi des demandes, changement de statut.
Gestion des utilisateurs avec rôles (admin / employé).
Tableau de bord avec statistiques (animaux disponibles, demandes en attente, adoptions finalisées).

### 2.3. Notifications
Email de confirmation envoyé au demandeur lors de sa demande.
Email au demandeur lors du changement de statut (accepté/refusé).
(Optionnel) Email interne au refuge lorsqu’une nouvelle demande est reçue.

### 2.4. Contraintes techniques
Application Laravel avec stack TALL (recommandée).
Base relationnelle (MySQL, MariaDB, PostgreSQL ou SQLite).
Stockage des photos d’animaux.
Mise en place d’un environnement de test (Pest, PHPUnit).

## 3. Développement par sprints

### Sprint 1 – Fondations et CRUD de base
Installation projet, base de données.
CRUD animaux (avec photo).
Affichage public simple (liste + détail).

### Sprint 2 – Authentification et rôles
Authentification utilisateurs.
Rôles admin/employé avec autorisations.
Gestion des utilisateurs.

### Sprint 3 – Demandes d’adoption
Formulaire public de demande d’adoption.
Liaison animal ↔ demandes.
Suivi des demandes dans le back-office.

### Sprint 4 – Notifications par email
Confirmation au demandeur lors de la création d’une demande.
Notification au demandeur lors du changement de statut.
(Bonus) Notification interne au refuge.

### Sprint 5 – Améliorations et tableau de bord
Tableau de bord avec statistiques.
Filtres, recherche, pagination.
Tests automatisés et documentation.

## 4. Organisation des tests (TDD)
### Tests unitaires
AnimalTest : attributs par défaut, validation des données, relation avec les demandes.
AdoptionRequestTest : lien obligatoire à un animal, statut évolutif, validation email.
### Tests fonctionnels
AnimalsTest : CRUD animaux, upload photo, affichage public.
AuthTest : connexion, rôles, autorisations.
AdoptionRequestsTest : création d’une demande publique, rejet si invalide, suivi par admin.
NotificationsTest : envoi des emails aux demandeurs, notification interne.
DashboardTest : affichage des statistiques correctes.
Écrire le code minimal pour le faire passer.
Refactoriser si besoin.
Répéter.
