# Istanbul Weather Module for Drupal

The "Istanbul Weather" module for Drupal 10 displays current weather information for Istanbul using the OpenWeatherMap API. This module enriches your site with real-time updates on temperature, humidity, wind conditions, and more, all presented in an easily manageable Drupal block.

## Features

- **Live Weather Updates:** Fetches and displays the current weather conditions in Istanbul.
- **Block Placement Flexibility:** Integrate the weather block into any region supported by your Drupal theme.
- **Secure API Key Configuration:** Safely stores the API key in Drupal's `settings.php`, ensuring it is not exposed in the source code.

## Requirements

- Drupal 10.x
- PHP 7.4 or higher
- Guzzle HTTP Client (included with Drupal core)

## Installation

To install the Istanbul Weather module, follow these steps:

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/yourusername/istanbul_weather.git modules/custom/istanbul_weather

2. **Enable the Module:**  :
Navigate to the Extend page in your Drupal administration area to enable the module, or use Drush:
```bash
  drush en istanbul_weather -y


4. **Configure the API Key::**
Securely add your OpenWeatherMap API key to the settings.php file:
```PHP
    $settings['istanbul_weather_api_key'] = 'your_openweathermap_api_key';

## Configuration
After installation, navigate to the Block Layout page (/admin/structure/block) in your Drupal admin panel. Place the “Istanbul Weather Block” in your desired region of the site.

## Customization
The module uses a Twig template (istanbul-weather-block.html.twig) that can be overridden in your theme for specific styling or layout changes.
CSS styling can be modified in the css/style.css file located within the module directory.
Contributing
Contributions to the Istanbul Weather module are welcome! Feel free to fork the repository, make improvements, and submit pull requests on GitHub.

## License
This project is licensed under the GNU General Public License v2.0 or later. See the LICENSE file in the repository for full details.
