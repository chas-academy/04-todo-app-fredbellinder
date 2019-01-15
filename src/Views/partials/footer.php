<footer class="footer">
<span class="todo-count">
    <?= count(
        array_filter(
            $todos,
            function ($todo) {
                return $todo['completed'] === "false";
            }
        )
    ) ?> item<?= "" . count(
        array_filter(
            $todos,
            function ($todo) {
                return $todo['completed'] === "false";
            }
        )
) != 1 ? "s" : "" ?> left</span>
    <form id="show-only" method="POST" action="/show-only" style="display: inline-block">
        <button class="clear-completed" name="all" style="display: inline-block">
            All
        </button>
        <button class="clear-completed" name="active" style="display: inline-block" value="false">
            Active
        </button>
        <button class="clear-completed" name="inactive" style="display: inline-block" value="true">
            Inactive
        </button>
    </form>
    <form method="post" action="/todos/clear-completed" style="display: inline-block">
        <button class="clear-completed" style="display: inline-block">Clear completed</button>
        
    </form>
</footer>

</main>

<footer class="site-footer">
    <div class="small-container">
    <p class="text-center">Made from Axels template by <a href="#">Fred Bellinder</a></p>
    </div>
</footer>

<script type="module" src="<?= $this->getScript('scripts'); ?>"></script>

</body>

</html>