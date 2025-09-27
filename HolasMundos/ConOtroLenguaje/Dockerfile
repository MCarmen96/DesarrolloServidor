# Dockerfile

# 1. ESPECIFICAR LA IMAGEN BASE
# Usamos una imagen oficial de Python como base
FROM python:3.10-slim

# 2. ESTABLECER EL DIRECTORIO DE TRABAJO
# El directorio dentro del contenedor donde se ejecutará la app
WORKDIR /app

# 3. COPIAR ARCHIVOS DE REQUISITOS E INSTALAR DEPENDENCIAS
# Copiar el archivo de requisitos e instalar las librerías necesarias
COPY requirements.txt .
RUN pip install -r requirements.txt

# 4. COPIAR EL CÓDIGO DE LA APLICACIÓN
# Copia el script de Python al directorio de trabajo
COPY app.py .
EXPOSE 5000
# 5. DEFINIR EL COMANDO DE EJECUCIÓN
# Especifica qué comando debe ejecutarse cuando el contenedor se inicie
CMD ["python", "app.py"]