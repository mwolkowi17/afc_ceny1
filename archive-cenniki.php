<?php get_header(); ?>
<div style="height: 300px; background-color: #291C0E;"></div>
<?php if (have_posts()) : ?>
    <div class="container mx-auto">
    <table class="table">
    <thead>
        <tr>
            
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Edycja</th>
        
        </tr>
    </thead>
    <tbody>
        <?php while (have_posts()) : the_post(); ?>
            
            <tr>
           
            <td><?php the_title() ?></td>
            <td><?php the_field('cena') ?> euro</td>
            <td> <a href="<?php the_permalink(); ?>"> Zobacz szczegóły</a></td>
           
        </tr>
        <?php endwhile; ?>
        </tbody>
        </table>
    </div>
<?php endif; ?>
<?php get_footer(); ?>