#!/usr/bin/env python3
import re
import hashlib
import sys
import json

def detect_hash(hash_string):
    """Détecte le type de hachage probable basé sur sa longueur, son format et ses caractéristiques"""
    
    # Nettoyage de la chaîne
    hash_string = hash_string.strip().lower()
    
    # Dictionnaire détaillé des types de hachage avec leurs caractéristiques
    HASH_PATTERNS = {
        32: {
            'types': ['MD5', 'RIPEMD-128', 'Haval-128', 'Tiger128'],
            'patterns': {
                'MD5': r'^[a-f0-9]{32}$',
                'RIPEMD-128': r'^[a-f0-9]{32}$',
                'Haval-128': r'^[a-f0-9]{32}$',
                'Tiger128': r'^[a-f0-9]{32}$'
            }
        },
        40: {
            'types': ['SHA-1', 'RIPEMD-160', 'Haval-160', 'Tiger160', 'HAS-160'],
            'patterns': {
                'SHA-1': r'^[a-f0-9]{40}$',
                'RIPEMD-160': r'^[a-f0-9]{40}$'
            }
        },
        48: {
            'types': ['Tiger192', 'Haval-192'],
            'patterns': {
                'Tiger192': r'^[a-f0-9]{48}$'
            }
        },
        56: {
            'types': ['SHA-224', 'Haval-224'],
            'patterns': {
                'SHA-224': r'^[a-f0-9]{56}$'
            }
        },
        64: {
            'types': ['SHA-256', 'RIPEMD-256', 'Haval-256', 'GOST', 'SNEFRU-256'],
            'patterns': {
                'SHA-256': r'^[a-f0-9]{64}$',
                'GOST': r'^[a-f0-9]{64}$'
            }
        },
        96: {
            'types': ['SHA-384'],
            'patterns': {
                'SHA-384': r'^[a-f0-9]{96}$'
            }
        },
        128: {
            'types': ['SHA-512', 'Whirlpool', 'SNEFRU-512'],
            'patterns': {
                'SHA-512': r'^[a-f0-9]{128}$',
                'Whirlpool': r'^[a-f0-9]{128}$'
            }
        }
    }
    
    # Caractéristiques spéciales pour certains hashs
    SPECIAL_CHARACTERISTICS = {
        'bcrypt': r'^\$2[ayb]\$[0-9]{2}\$[A-Za-z0-9./]{53}$',
        'SHA-512 crypt': r'^\$6\$[a-zA-Z0-9./]{8}\$[a-zA-Z0-9./]{86}$',
        'MD5 crypt': r'^\$1\$[a-zA-Z0-9./]{8}\$[a-zA-Z0-9./]{22}$',
        'PHPass': r'^\$P\$[a-zA-Z0-9./]{31}$',
        'Drupal7': r'^\$S\$[a-zA-Z0-9./]{52}$',
        'Argon2': r'^\$argon2[id]\$v=19\$m=[0-9]+,t=[0-9]+,p=[0-9]+\$[a-zA-Z0-9+/]+\$[a-zA-Z0-9+/]+'
    }
    
    # Vérification des formats spéciaux
    for hash_type, pattern in SPECIAL_CHARACTERISTICS.items():
        if re.match(pattern, hash_string):
            return {
                "length": len(hash_string),
                "possible_types": [hash_type],
                "confidence": "Élevée (Format spécifique détecté)"
            }
    
    # Vérification du format hexadécimal standard
    if not re.match(r'^[a-f0-9]+$', hash_string):
        return {
            "error": "Format invalide - Le hachage doit être en hexadécimal",
            "format_detected": "Non-hexadécimal"
        }
    
    hash_length = len(hash_string)
    
    # Si la longueur correspond à un type connu
    if hash_length in HASH_PATTERNS:
        possible_types = []
        exact_matches = []
        
        # Vérification des patterns spécifiques
        for hash_type, pattern in HASH_PATTERNS[hash_length]['patterns'].items():
            if re.match(pattern, hash_string):
                exact_matches.append(hash_type)
        
        # Si des correspondances exactes sont trouvées
        if exact_matches:
            confidence = "Élevée"
            possible_types = exact_matches
        else:
            confidence = "Moyenne"
            possible_types = HASH_PATTERNS[hash_length]['types']
        
        return {
            "length": hash_length,
            "possible_types": possible_types,
            "confidence": confidence,
            "characteristics": {
                "all_hex": bool(re.match(r'^[a-f0-9]+$', hash_string)),
                "contains_special": bool(re.search(r'[^a-f0-9]', hash_string))
            }
        }
    
    return {
        "length": hash_length,
        "possible_types": ["Type de hachage inconnu"],
        "confidence": "Faible",
        "note": "Longueur non standard pour les algorithmes de hachage courants"
    }

# Lecture du hash depuis le fichier JSON
with open("data.json", "r") as file:
    data = json.load(file)
    hash = data["hash"]

# Analyse et sortie du résultat
result = detect_hash(hash)
print(json.dumps(result))
