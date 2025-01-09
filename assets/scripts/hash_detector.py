#!/usr/bin/env python3
import re
import hashlib
import sys
import json

def detect_hash(hash_string):
    """Détecte le type de hachage probable basé sur sa longueur et son format"""
    
    # Nettoyage de la chaîne
    hash_string = hash_string.strip().lower()
    
    # Dictionnaire des types de hachage communs et leurs caractéristiques
    HASH_TYPES = {
        32: ['MD5', 'RIPEMD-128', 'Haval-128'],
        40: ['SHA-1', 'RIPEMD-160', 'Haval-160'],
        56: ['SHA-224', 'Haval-224'],
        64: ['SHA-256', 'RIPEMD-256', 'Haval-256'],
        96: ['SHA-384'],
        128: ['SHA-512', 'Whirlpool']
    }
    
    # Vérification du format hexadécimal
    if not re.match(r'^[a-f0-9]+$', hash_string):
        return "Format invalide - Le hachage doit être en hexadécimal"
    
    # Détection basée sur la longueur
    hash_length = len(hash_string)
    
    if hash_length in HASH_TYPES:
        return {
            "length": hash_length,
            "possible_types": HASH_TYPES[hash_length]
        }
    
    return {
        "length": hash_length,
        "possible_types": ["Type de hachage inconnu"]
    }



with open("data.json", "r") as file:
    data = json.load(file)
    hash = data["hash"]

result = detect_hash(hash)
print(json.dumps(result))
