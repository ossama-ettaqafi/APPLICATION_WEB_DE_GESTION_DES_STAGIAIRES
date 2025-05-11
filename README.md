# 📄 Application de Gestion des Stagiaires – Version CRUD Simple

> Application web permettant uniquement la gestion basique des stagiaires et la génération d'attestations de stage.

## 🎯 Objectifs

* 👤 Gérer les fiches stagiaires (création, modification, suppression, consultation).
* 🧾 Générer et imprimer des attestations de fin de stage (PDF).
* 💾 Stocker les données dans une base fiable (MySQL).

## 👥 Utilisateurs

| Rôle                 | Description                                                              |
| -------------------- | ------------------------------------------------------------------------ |
| 👩‍💼 Administrateur | Peut effectuer toutes les opérations CRUD + impression des attestations. |

## ⚙️ Fonctionnalités principales

* ➕ **Ajouter un stagiaire** (nom, prénom, email, téléphone, date de début/fin, service).
* ✏️ **Modifier une fiche stagiaire**.
* ❌ **Supprimer un stagiaire**.
* 🔍 **Consulter la liste des stagiaires** (table avec pagination/recherche).
* 🧾 **Générer une attestation de stage en PDF** pour chaque stagiaire.

## 🧱 Technologies utilisées

| Composant        | Technologie                              |
| ---------------- | ---------------------------------------- |
| Frontend         | HTML · CSS · Bootstrap · JavaScript      |
| Backend          | Laravel (PHP)                            |
| Base de données  | MySQL                                    |
| PDF              | Laravel DOMPDF (ou SnappyPDF)            |
| Authentification | Simple (si nécessaire) avec Laravel Auth |

## 📐 Contraintes techniques

* 📱 Interface responsive simple (Bootstrap).
* 📄 Attestation PDF personnalisée avec nom, durée, service, etc.
* ✅ Validation des champs à l’ajout/modification.
* 📦 Application mono-utilisateur ou accès protégé simple.
  
## ✅ Exemple de flux

1. Admin se connecte.
2. Accède à une liste des stagiaires.
3. Ajoute un nouveau stagiaire via un formulaire.
4. Clique sur "Imprimer attestation" → Génère un PDF avec les infos du stagiaire.
5. Le PDF est téléchargeable ou imprimable directement.
