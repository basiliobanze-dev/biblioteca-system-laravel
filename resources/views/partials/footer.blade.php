<footer style="background-color: #2c3e50; color: #ecf0f1; padding: 60px 20px;">
    <div class="container" style="max-width: 1100px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 40px;">
        
        <div style="flex: 1; min-width: 220px; text-align: left;">
            <h4 style="margin-bottom: 15px;">📚 Minha Biblioteca</h4>
            <p style="font-size: 14px; line-height: 1.6;">
                Gestão de livros com facilidade, elegância e eficiência.
            </p>
        </div>

        <div style="flex: 1; min-width: 220px; text-align: left;">
            <h4 style="margin-bottom: 15px;">🔗 Links Rápidos</h4>
            <ul style="list-style: none; padding: 0; font-size: 14px;">
                <li><a href="{{ route('books.index') }}" style="color: #ecf0f1; text-decoration: none;">📘 Livros</a></li>
                <li><a href="{{ route('books.create') }}" style="color: #ecf0f1; text-decoration: none;">➕ Adicionar Livro</a></li>
                <li><a href="#" style="color: #ecf0f1; text-decoration: none;">📄 Termos e Condições</a></li>
            </ul>
        </div>

        <div style="flex: 1; min-width: 220px; text-align: left;">
            <h4 style="margin-bottom: 15px;">📞 Contacto</h4>
            <p style="font-size: 14px; line-height: 1.6;">
                +258 XX XXX XXXX<br>
                ✉️ contacto@biblioteca.com
            </p>
        </div>

    </div>

    <div style="text-align: center; margin-top: 40px; font-size: 13px; color: #bdc3c7;">
        &copy; {{ date('Y') }} Minha Biblioteca. Todos os direitos reservados.
    </div>
</footer>
