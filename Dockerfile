# 1. Use the official PHP image based on Alpine
FROM php:8.2-alpine

# 2. Set the working directory for the application
WORKDIR /app

# 3. Copy your PHP file into the container
COPY index.php .

# 4. Expose the port
EXPOSE 80

# 5. Start PHP's built-in web server when the container launches
CMD ["php", "-S", "0.0.0.0:80"]
