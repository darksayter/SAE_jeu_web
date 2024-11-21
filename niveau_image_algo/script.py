from PIL import Image
import random

#SCRIPT POUR CRYPTER L'IMAGE

input_path = "MOTDEPASSE.png"
output_path = "image_modifiee.png"
img = Image.open(input_path).convert("L")
width, height = img.size

output_img = Image.new("RGBA", (width, height))

for x in range(width):
    for y in range(height):
        pixel = img.getpixel((x, y))
        
        color = (random.randint(0, 255), random.randint(0, 255), random.randint(0, 255))
        
        if pixel > 127:
            alpha = int(0.49 * 255)
        else: 
            alpha = int(0.51 * 255)
        
        output_img.putpixel((x, y), (*color, alpha))

output_img.save(output_path)
print("Image transformée et sauvegardée !")
