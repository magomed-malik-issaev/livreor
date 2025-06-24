const express = require('express');
const cors = require('cors');
const mongoose = require('mongoose');
const path = require('path');
const app = express();

app.use(cors());
app.use(express.json());



app.listen(3000, () => {
    console.log('Serveur démarré sur http://localhost:3000');
});

mongoose.connect('mongodb://127.0.0.1:27017/livreor')
    .then(() => console.log("connexion à la base de données réussie"))
    .catch(err => console.error("erreur de connexion", err));

// Modèle de message pour le livre d'or
const Message = mongoose.model('Message', {
    nom: { type: String, required: true },
    message: { type: String, required: true },
    note: { type: Number, min: 1, max: 5 },
    date: { type: Date, default: Date.now }
});
app.use(express.static(path.join(__dirname, 'public')));

// POST : ajouter un message
app.post('/messages', async (req, res) => {
    try {
        console.log("Données reçues :", req.body);
        const { nom, message, note } = req.body;
        const nouveau = new Message({ nom, message, note });
        await nouveau.save(); // enregistrement dans MongoDB
        console.log("Message enregistré dans MongoDB :", nouveau);
        res.status(201).json(nouveau);
    } catch (err) {
        res.status(400).json({ erreur: err.message });
    }
});

// GET : lire tous les messages (du plus récent au plus ancien)
app.get('/messages', async (req, res) => {
    try {
        const messages = await Message.find().sort({ date: -1 });
        res.json(messages);
    } catch (err) {
        res.status(500).json({ erreur: err.message });
    }
});



