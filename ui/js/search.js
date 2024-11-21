document.getElementById('search').addEventListener('input', function() {
    const query = this.value.toLowerCase(); // Captura o que foi digitado
    const searchResultsContainer = document.getElementById('search-results');

    if (query === '') {
        searchResultsContainer.style.display = 'none';
        return; // Não continua a execução do código
      }
    
    // Lista de tópicos do fórum, você pode usar PHP para gerar isso dinamicamente do banco de dados
    const forums = [
      { title: 'Info - TI', description: 'Informações e perguntas relacionadas aos cursos de TI.' },
      { title: 'Info - Direito', description: 'Informações e perguntas relacionadas aos cursos de Direito.' },
      { title: 'Info - Saúde', description: 'Informações e perguntas relacionadas aos cursos de Saúde.' },
      { title: 'Info - Marketing', description: 'Discussões sobre estratégias de marketing.' }
    ];
  
    // Filtra os itens com base na busca
    const filteredForums = forums.filter(forum => 
      forum.title.toLowerCase().includes(query) || 
      forum.description.toLowerCase().includes(query)
    );
  
    // Limpa os resultados anteriores
    searchResultsContainer.innerHTML = '';
  
    // Exibe os resultados
    if (filteredForums.length > 0) {
      filteredForums.forEach(forum => {
        const resultItem = document.createElement('div');
        resultItem.classList.add('search-item');
        resultItem.innerHTML = `<strong>${forum.title}</strong><br><small>${forum.description}</small>`;
        searchResultsContainer.appendChild(resultItem);
      });
      
      // Exibe a caixa de resultados
      searchResultsContainer.style.display = 'block';
    } else {
      // Se não houver resultados, esconde a caixa
      searchResultsContainer.style.display = 'none';
    }
  });