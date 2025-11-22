Endpoints:

<code>/api/banned</code> for display banned pokemons
<code>/api/banned/store</code> for store pokemon (fetch data from api by pokemon name)
<ul>name: required</ul>
<code>/api/banned/{id}</code> for destroy pokemon
<ul>id: required</ul>

<code>/api/info?names=...</code> for display specific pokemons data
<ul>?names: required, string</ul>

<code>/api/custom</code> for display custom pokemons data
<code>/api/custom/store</code> for create custom pokemon
<ul>fields
<li>name: required, string</li>
<li>description: nullable, string</li>
<li>height: required, integer</li>
<li>weight: required, integer</li>
<li>damage: required, integer</li>
<li>type: required, string</li>
</ul>
<code>/api/custom/update/{id}</code>
<ul>fields
<li>name: required, string</li>
<li>description: nullable, string</li>
<li>height: required, integer</li>
<li>weight: required, integer</li>
<li>damage: required, integer</li>
<li>type: required, string</li>
</ul>
<code>/api/custom/destroy/{id}</code>
<ul>id: required</ul>

Deploy:
<br />
1. <code>git clone git@github.com:patryk-lukasz-kacprowicz/PokeWiki.git</code>
2. <code>composer install --optimize-autoloader</code>
3. <code>cp .env.example .env</code>
4. <code>php artisan key:generate</code>
5. <code>Configure database data in .env file</code>
6. <code>Configure secret key in .env file</code>
7. <code>php artisan migrate</code>

<h3>How the code works</h3>

Data retrieval from the API works on a search basis. If the user selects a Pokémon that is not in the database but exists in the API, it will first be added to the database and then its data will be displayed.
