# [](#server-side-rendered--code-split-react--WordPress-rest-api---built-by-keen-wip)SSR / React Code Split + Headless WordPress + REST API (WIP)

This repo is based on a [boilerplate](https://github.com/trouble/react-wp-rest) for pairing the WP Rest API with a server-side rendered and code-split React client, built by Keen Studios. I recently resurrected it by updating dependencies and adding a new docker-compose file consistent with recent updates.

I built this out a few years ago to test drive the headless concept and to utilize a page-template-driven approach, which was not easily done at the time in NextJS.

WordPress, MySQL, PHP, and PHPMyAdmin are provided by Docker which makes it easy to spin up new WP sites for both local development and production. No need for MAMP, XAMPP, etc!

## [](#getting-started)Start with the Client

Clone this repository locally and `cd` to the `client` folder and type:
`npm install`.

## [](#set-up-environment)Set up the Environment

The React app relies on a `.env` file to configure itself to its environment, and this repo ships with an example that you can copy and rename. While in the `/client` directory, duplicate/rename `.env.example`. The example `.env` file comes preloaded with the URL to the default Docker installation of WordPress.

### [](#docker)Docker

Make sure you have Docker Desktop installed locally. Then `cd` to the `/api` directory to duplicate and rename `docker-compose.yml.example`, which has been updated with the latest changes in Docker Compose. Edit `api/docker-compose.yml` to link your local filesystem with Docker's WordPress files, as follows:

**NOTE:** Change the path located _before_ the colon. In this case, replace `~/www/mah-wp-rest` with your install directory if you have changed the root directory name.

      volumes:
        - ~/www/mah-wp-rest/api:/var/www/html

Next, fire up Docker Desktop if it isn't running already. While you're still in the `api` directory, type `docker-compose up -d`. You will see the containers starting up and you should now be able to reach your WP instance via `http://localhost:8080`, where you should see the WordPress install screen.

Go through the steps to install WordPress and confirm that you can log into the Admin area.

### [](#optional-configuration) Optional Configuration

- You can reach `PhpMyAdmin` at the port specified in the YML file if you need to import another database
- To clean up your local environment, you can update the volumes in the YML file to map only the `wp-content` directory:
  ` volumes:
    - ./wp-content:/var/www/html/wp-content`

## [](#WordPress-configuration)WordPress Configuration

After you're up and running, navigate to `http://localhost:8080/wp-admin` and perform the following steps in WordPress:

1.  Activate the `REST API` theme
2.  Install / Activate the following plugins:

- Advanced Custom Fields Pro (ACF)
- ACF to REST API

3. Some boilerplate `Meta` ACF custom fields are available to be imported by navigating to `ACF -> Tools`, and importing `api/acf/acf-meta.data.json`. This will add meta fields to each Page and Post by default, avoiding the need for Yoast SEO or similar plugins. Extend and add to other post types and field groups as needed.
4. Add a new page called `Home`, set it to use the `Home` page template, and then set it as your front page in the `Settings -> Reading -> Your homepage displays` section.

5. Change Permalinks to the 'Custom Structure' option and enter `/post/%postname%/`
6. Update your Site Address within `Settings -> General` to your SSR app (default: [http://localhost:1337](http://localhost:1337))

**Note:** It's important that the Site Address update is performed last in the order above.

### [](#booting-up-the-ssr-app)Booting up the SSR app

The SSR configuration in place serves the `/client/build` folder on port `1337`. Before attempting to test SSR, run `npm run build`. After that, run `npm run start` while still in the `/client` directory will fire up the server and watch for changes.

At this point, you can get to work.

## [](#sass)Sass

This repo has been updated to use `Dart sass` as `node-sass` has been deprecated since this theme was created. I retained the practice of using separate `scss` files for each component - but you can structure your project however you'd like, and update the `scripts` in `package.json` to reflect your requirements.

## [](#caching-api-responses-on-the-server-side)Caching API responses

Redux is used both on the server and the client to cache the site content provided by WordPress in memory. This is a very simple approach but it works quite well in practice.

The first time a client requests a server-rendered copy of a page, Node serves the contents of the `build` folder, without waiting for the asynchronous calls to the WP REST API.

This first call populates the in-memory Redux store - therefore any consecutive requests by clients to the same server-rendered page will automatically pull from the Redux store - and will automatically populate the data from WP.

## [](#template-usage)Template Usage

This theme relies on WordPress page templates to assign ACF custom fields to pages as needed. For example, a Homepage will generally require different custom fields than a typical About page. By creating empty templates in the `/api/wp-content/themes/rest-api` folder, we can assign them to pages we create within WordPress. We then can write ACF logic to apply custom field groups to pages that use specific page templates, and then we can mirror the same template structure on the client side, but built with React components.

### Page Templates in ACF + React

As noted above, I wanted to be able to duplicate and expand on my extensive work using ACF to create page templates with layouts to avoid page builders. I have had great success using these flexible page templates for large and small clients.

The `ACF to API` plugin adds an `acf` endpoint to the API, enabling the ACF templates to grab the data they need.

**Update:** For this theme, the REST API works well. I have looked at using GraphQL, but the queries become quite complex because of the nature of the fields in ACF. Hitting the `acf` endpoint makes it possible to grab all the layouts and their fields and sub-fields without explicitly requesting them. Since we are caching the API responses, this is sufficient at the moment.

I am currently (as of Jan 2024) building out a new headless instance using NextJS 14, which renders React Server components by default, making GraphQL less necessary.

### Styling

This project uses Webpack to compile SASS to css. To iterate quickly, I've used Bootstrap, with component-level overrides.

### Next Steps and TODOs

- Integrate GraphQL?
- Add design and content
- Additional components
  - forms
  - sliders
  - hero component
