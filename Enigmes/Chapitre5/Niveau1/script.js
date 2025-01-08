// Liste des énigmes à résoudre
const enigmes = [
  { question: "Quel est le résultat de 5 + 3 ?", reponse: "8" },
  { question: "Quel est le résultat de 9 - 4 ?", reponse: "5" },
  { question: "Quel est le résultat de 6 x 2 ?", reponse: "12" },
  { question: "Quel est le résultat de 16 ÷ 4 ?", reponse: "4" },
  { question: "Quel est le carré de 3 ?", reponse: "9" },
  { question: "Quel est le résultat de 7 + 6 ?", reponse: "13" },
  { question: "Quel est le double de 4 ?", reponse: "8" },
  { question: "Quel est le résultat de 15 - 8 ?", reponse: "7" },
  { question: "Combien de côtés a un carré ?", reponse: "4" },
  { question: "Quel est le résultat de 10 x 10 ?", reponse: "100" },
  { question: "Quel est le résultat de 3 x 7 ?", reponse: "21" },
  { question: "Combien de secondes dans une minute ?", reponse: "60" },
  { question: "Quel est le résultat de 8 ÷ 2 ?", reponse: "4" },
  { question: "Quel est le carré de 5 ?", reponse: "25" },
  { question: "Quel est le résultat de 11 - 5 ?", reponse: "6" },
  { question: "Quel est le double de 6 ?", reponse: "12" }
];

const pieces = document.querySelectorAll('.puzzle-piece');
const enigmeDiv = document.getElementById('enigme');
const inputReponse = document.getElementById('reponse');
const boutonVerifier = document.getElementById('verifier');
let currentEnigmeIndex = 0;

// Mélanger les pièces du puzzle au début
function melangerPieces() {
  const indices = [...Array(pieces.length).keys()];

  // Mélanger les indices
  for (let i = indices.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [indices[i], indices[j]] = [indices[j], indices[i]];
  }

  // Appliquer le mélange
  pieces.forEach((piece, index) => {
    const x = indices[index] % 4;
    const y = Math.floor(indices[index] / 4);

    piece.style.backgroundColor = "#ccc"; // Pièce grise au début
    piece.style.backgroundSize = "800px 400px"; // Taille de l'image complète
    piece.setAttribute('data-degri', 'false'); // Marquer la pièce comme grisée
    piece.setAttribute('data-id', indices[index]); // Ajouter un ID unique pour chaque pièce
    piece.style.backgroundPosition = `${x * -200}px ${y * -100}px`; // Position mélangée de l'image
  });
}

// Choisir une pièce aléatoire qui n'est pas encore dégrisée
function choisirPieceAleatoire() {
  const piecesNonDegri = [];
  pieces.forEach((piece, index) => {
    if (piece.getAttribute('data-degri') === 'false') {
      piecesNonDegri.push(index);
    }
  });

  if (piecesNonDegri.length === 0) {
    return null;
  }

  const randomIndex = Math.floor(Math.random() * piecesNonDegri.length);
  return piecesNonDegri[randomIndex];
}

// Vérification de la réponse
function verifierReponse() {
  if (inputReponse.value === enigmes[currentEnigmeIndex].reponse) {
    const randomPieceIndex = choisirPieceAleatoire();
    if (randomPieceIndex !== null) {
      const piece = pieces[randomPieceIndex];

      // Débloquer la pièce du puzzle
      piece.classList.add('degri');
      piece.setAttribute('data-degri', 'true'); // Marquer la pièce comme dégrisée

      // Afficher l'image du puzzle sur la pièce
      const position = piece.style.backgroundPosition;
      piece.style.backgroundImage = `url('mail.png')`;
      piece.style.backgroundPosition = position; // Garder la position
      piece.style.backgroundColor = "transparent"; // Enlever le gris
    }

    currentEnigmeIndex++;
    inputReponse.value = "";

    if (currentEnigmeIndex < enigmes.length) {
      afficherEnigme();
    } else {
      alert("Félicitations ! Vous avez décrypté le message !");
    }
  } else {
    alert("Mauvaise réponse, essayez encore !");
  }
}

// Fonction pour afficher une nouvelle énigme
function afficherEnigme() {
  if (currentEnigmeIndex < enigmes.length) {
    enigmeDiv.textContent = enigmes[currentEnigmeIndex].question;
  }
}

// Initialisation du jeu
melangerPieces();
afficherEnigme();
boutonVerifier.addEventListener('click', verifierReponse);

// Drag-and-drop
// Drag-and-drop
function dragStart(event) {
  event.dataTransfer.setData("text", event.target.dataset.id);
}

function allowDrop(event) {
  event.preventDefault();
}

function drop(event) {
  event.preventDefault();

  const draggedPieceId = event.dataTransfer.getData("text");
  const draggedPiece = document.querySelector(`[data-id='${draggedPieceId}']`);
  const targetPiece = event.target;

  if (draggedPiece !== targetPiece && targetPiece.classList.contains('puzzle-piece')) {
    // Récupérer les positions et les états grisés des deux cases
    const draggedPiecePos = draggedPiece.style.backgroundPosition;
    const draggedPieceDegri = draggedPiece.getAttribute('data-degri');
    const targetPiecePos = targetPiece.style.backgroundPosition;
    const targetPieceDegri = targetPiece.getAttribute('data-degri');

    // Échanger les positions de fond
    draggedPiece.style.backgroundPosition = targetPiecePos;
    targetPiece.style.backgroundPosition = draggedPiecePos;

    // Échanger les états grisé/dégrisé
    draggedPiece.setAttribute('data-degri', targetPieceDegri);
    targetPiece.setAttribute('data-degri', draggedPieceDegri);

    // Mettre à jour les visuels en fonction de l'état (grisé ou dégrisé)
    mettreAJourGrisure(draggedPiece);
    mettreAJourGrisure(targetPiece);
  }
}

// Fonction pour mettre à jour visuellement la grisure ou l'image
function mettreAJourGrisure(piece) {
  if (piece.getAttribute('data-degri') === 'false') {
    piece.style.backgroundImage = ""; // Pas d'image si grisé
    piece.style.backgroundColor = "#ccc"; // Couleur grise
  } else {
    piece.style.backgroundImage = `url('mail.png')`; // Afficher l'image
    piece.style.backgroundColor = "transparent"; // Fond transparent
  }
}

// Appliquer les gestionnaires d'événements sur chaque pièce
pieces.forEach(piece => {
  piece.addEventListener('dragstart', dragStart);
  piece.addEventListener('dragover', allowDrop);
  piece.addEventListener('drop', drop);
});
