<?php

use yii\db\Migration;

/**
 * Class m240913_122240_seed_book_table
 */
class m240916_103357_seed_book extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('book', ['isbn','title','author', 'price','inventory'], [
            ['9788545702870','Akira', 'KATSUHIRO OTOMO',35.8, 200],
            ['9786558671183','Dom Casmurro: e-book (professor)', 'Machado de Assis',40, 350],
            ['9786558670841','O Alienista: e-book (professor)', 'Machado de Assis',50, 20],
            ['9786558670094','Português Linguagens 4º Ano (aluno)', 'CAROLINA DIAS VIANNA',100, 50],            
            ['9788577020663','O Primo Basílio', 'José Maria de Eça de Queirós',60, 300],
            ['9788573025165','Memórias Póstumas de Brás Cubas', 'Machado de Assis',55, 400],
            ['9788577260163','O Guarani', 'José de Alencar',30, 100],
            ['9788535931218','Dom Quixote', 'Miguel de Cervantes',70, 250],
            ['9788555590013','O Cortiço', 'Aluísio Azevedo',50, 150],
            ['9788535930303','Iracema', 'José de Alencar',40, 200],
            ['9788573025608','O Casmurro', 'Machado de Assis',45, 300],
            ['9788520931239','A Escrava Isaura', 'Bernardo Guimarães',35, 180],
            ['9788577023879','A Moreninha', 'Joaquim Manuel de Macedo',60, 220],
            ['9788573025127','A Divina Comédia', 'Dante Alighieri',100, 30],
            ['9788573025411','O Pequeno Príncipe', 'Antoine de Saint-Exupéry',25, 400],
            ['9788573025428','Harry Potter e a Pedra Filosofal', 'J.K. Rowling',70, 500],
            ['9788573025435','1984', 'George Orwell',50, 280],
            ['9788535931294','O Senhor dos Anéis', 'J.R.R. Tolkien',80, 100],
            ['9788535932185','A Metamorfose', 'Franz Kafka',45, 300],
            ['9788535932208','O Processo', 'Franz Kafka',55, 250],            
            ['9788535929987','O Lobo da Estepe', 'Hermann Hesse',40, 150],
            ['9788573025404','Orgulho e Preconceito', 'Jane Austen',35, 180],            
            ['9788501100017','A Guerra dos Mundos', 'H.G. Wells',45, 300],
            ['9788573025411','O Retrato de Dorian Gray', 'Oscar Wilde',60, 220],
            ['9788535932265','O Grande Gatsby', 'F. Scott Fitzgerald',55, 250],
            ['9788535932272','Moby Dick', 'Herman Melville',50, 180],            
            ['9788535932296','Frankenstein', 'Mary Shelley',40, 350],
            ['9788595088484','O Tempo e o Vento', 'Érico Veríssimo',75, 200],
            ['9788535932302','A Revolução dos Bichos', 'George Orwell',35, 400],
            ['9788535932319','O Sol é Para Todos', 'Harper Lee',50, 300],
            ['9788573025420','A Casa dos Espíritos', 'Isabel Allende',60, 200],
            ['9788535932326','O Último dos Moicanos', 'James Fenimore Cooper',45, 150],
            ['9788535932333','O Morro dos Ventos Uivantes', 'Emily Brontë',70, 100],
            ['9788535932340','A Cidade e as Serras', 'Eça de Queirós',90, 50],
            ['9788573025437','O Médico e o Monstro', 'Robert Louis Stevenson',40, 300],            
            ['9788535932357','Cem Anos de Solidão', 'Gabriel García Márquez',65, 250],
            ['9788535932364','A Montanha Mágica', 'Thomas Mann',80, 100],
            ['9788535932371','O Nome da Rosa', 'Umberto Eco',70, 150],
            ['9788535932388','O Alquimista', 'Paulo Coelho',25, 350],
            ['9788535932395','Homo Deus', 'Yuval Noah Harari',55, 200],
            ['9788535932401','Sapiens', 'Yuval Noah Harari',60, 250],
            ['9788535932418','A Arte da Guerra', 'Sun Tzu',45, 300],
            ['9788535932425','A Mente Organizada', 'Daniel J. Levitin',50, 180],
            ['9788535932432','Inteligência Emocional', 'Daniel Goleman',35, 400],
            ['9788535932449','O Poder do Hábito', 'Charles Duhigg',40, 350],
            ['9788535932456','Por que Fazemos o Que Fazemos?', 'Mario Sergio Cortella',30, 500],
        ]);
        
        
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', ['username' => ['admin', 'user']]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240913_122240_seed_book_table cannot be reverted.\n";

        return false;
    }
    */
}
