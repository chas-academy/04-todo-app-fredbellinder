<header class="header">
    <h1>To-Do</h1>
    <form id="create-todo" method="post" action="todos">
      <input name="title" class="new-todo" placeholder="What needs to be done?" autofocus>
    </form>
</header>

<section class="main">
<form id="toggleall" method="post" action="/todos/toggle-all">
        <input id="toggle-all" class="toggle-all" type="checkbox" name="toggler" onChange="this.form.submit();" <?= count(
            array_filter(
                $todos,
                function ($todo) {
                    return $todo['completed'] === "true";
                }
            )
        ) === count($todos) ? 'checked="true"' : "" ?>>
        <label for="toggle-all">Mark all as complete</label>
    </form>
</section>