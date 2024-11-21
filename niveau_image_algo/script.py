from PIL import Image
import random

#SCRIPT

input_path = "MOTDEPASSE.png"
output_path = "image_modifiee.png"
img = Image.open(input_path).convert("L")
width, height = img.size

output_img = Image.new("RGBA", (width, height))

for x in range(width):
    for y in range(height):
        # Obtenir la valeur du pixel (0 pour noir, 255 pour blanc)
        pixel = img.getpixel((x, y))
        
        # Générer une couleur aléatoire (R, G, B)
        color = (random.randint(0, 255), random.randint(0, 255), random.randint(0, 255))
        
        # Définir l'opacité : 49% pour blanc, 51% pour noir
        if pixel > 127:  # Considéré comme blanc
            alpha = int(0.49 * 255)
        else:  # Considéré comme noir
            alpha = int(0.51 * 255)
        
        # Appliquer le nouveau pixel à l'image de sortie
        output_img.putpixel((x, y), (*color, alpha))

# Sauvegarder l'image modifiée
output_img.save(output_path)
print("Image transformée et sauvegardée !")
