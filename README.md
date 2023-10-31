# ShareX Custom Uploader

This script allows you to set up a custom file uploader for ShareX, a popular screenshot and file sharing tool. It generates a unique URL for each uploaded file and requires an authentication key for access control.

## Prerequisites

Before you get started, make sure you have the following:

- [Composer](https://getcomposer.org/): To install PHP dependencies.
- A web server with PHP support (e.g., Apache, Nginx).
- [ShareX](https://getsharex.com/): Installed on your computer.
- Generate a secure authentication key [here](https://randomkeygen.com/).

## Setup

1. Clone or download this repository to your web server.

2. Install Composer if you haven't already. You can follow the installation instructions on the [Composer website](https://getcomposer.org/download/).

3. In the project directory, run the following command to install PHP dependencies:

```bash
composer install
```

4. Edit the Existing .env File with Your Configuration

To set up your custom uploader, edit the provided .env file with your configuration settings.

Here's an example of how your .env file might look:

```bash
AUTHENTICATION_KEY=YourAuthenticationKey
UPLOAD_DIRECTORY=ss/
DOMAIN_URL=https://yourdomain.com/
STRING_LENGTH=5
```


- **AUTHENTICATION_KEY:** Your secure password for authentication.
- **UPLOAD_DIRECTORY:** The directory where files will be uploaded.
- **DOMAIN_URL:** Your domain URL for generating file URLs.
- **STRING_LENGTH:** The desired length of the random string for file names.

**Configure ShareX:**

1. Open ShareX on your computer.
2. Go to `Destinations` and select `Custom uploader settings`.
3. Click `New` under `Uploaders`.
4. Set `Name` to `Your Custom Uploader`.
5. Set `Method` to `POST`.
6. Set `Request URL` to `https://yourdomain.com/uploader.php`.
7. Set `Body` to `Form data (multipart/form-data)`.
8. Add a `Name` field with the name `authenticationKey` and the value being your `AUTHENTICATION_KEY`.
9. Set `File from name` to `sharex`.
10. Save the settings.

**Usage:**

1. Take a screenshot or capture a file using ShareX.
2. ShareX will automatically upload the file to your custom uploader.
3. ShareX will provide you with a unique URL for the uploaded file, which you can share with others.

**Troubleshooting:**

- If you encounter issues, make sure the permissions and directory structure are set up correctly for the upload directory.
- Ensure that the .env file is properly configured with the correct values.
- Check ShareX settings to ensure that the URL and authentication key match your configuration.

**License:**

This project is licensed under the MIT License. See the LICENSE file for details.
