# app.py
print("¡Hola Mundo desde Python y Docker!")

from flask import Flask

# Crea la aplicación Flask
app = Flask(__name__)

@app.route('/')
def hola_mundo_web():
    # Retorna HTML (etiquetas <h1>)
    return "<h1>¡Hola Mundo Web desde Python y Docker!</h1>"

if __name__ == '__main__':
    # Flask debe escuchar en '0.0.0.0' para ser accesible desde Docker
    # Escuchará en el puerto 5000 por defecto
    app.run(host='0.0.0.0', port=5000)

"""
    3. Ejecutar y Mapear el Puerto
    Este es el paso clave para que lo veas en el navegador. 
    Usarás el flag -p para mapear el puerto interno del contenedor (5000) a un puerto de tu máquina (usaremos el 8080 como ejemplo, pero puedes usar cualquiera libre).
    
    docker run -d -p 8080:5000 mi-hola-python-web

    -d: Ejecuta el contenedor en modo detached (en segundo plano), ya que es un servidor continuo.
    -p 8080:5000: Mapea el puerto 8080 de tu máquina (<host_port>) al puerto 5000 del contenedor (<container_port>).

    para verificar que se esta ejecutando-> docker ps
    para pararlo-> docker stop <ID_o_Nombre_del_Contenedor>

"""