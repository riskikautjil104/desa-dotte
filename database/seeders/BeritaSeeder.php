<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('beritas')->insert([
            'judul' => 'Peresmian dan Penyerahan Website Desa Detto',
            'slug' => 'peresmina-dan-penyerahan-website-Desa-detto',
            'gambar' => 'beritaGambar/Iiuygndcw6256CMPyqkovGrGMHkPk1fnDFKDHchw.jpg',
            'isi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem molestias quis minus natus dolor. Dignissimos pariatur est magnam cumque doloremque accusantium illo culpa porro, iste suscipit quaerat minus praesentium laboriosam quod expedita optio ullam quisquam, eius illum obcaecati. Quaerat veniam quas ex dolorum delectus eveniet distinctio quae atque vel nobis? Inventore necessitatibus illo neque ut alias. Eos atque fugiat neque nostrum, aut nesciunt repellat minus maxime velit commodi dolores non, dolorem sapiente id officia reprehenderit corrupti quibusdam dolor numquam nam unde. Fuga laudantium repellendus excepturi velit? Velit illum unde blanditiis! Laborum, provident neque! Asperiores ipsa iste voluptatibus temporibus odit soluta? Sit quos veritatis nemo atque labore, neque hic necessitatibus debitis rem fugiat dolorem qui perspiciatis tempore dolorum fugit. Saepe minus atque, itaque iure dolorum explicabo libero labore cumque at quas aspernatur eius nobis qui eaque reiciendis quis nulla blanditiis, eum similique hic nihil quibusdam modi adipisci praesentium. Eos minima magnam earum doloremque dolor accusantium placeat explicabo ut voluptatem, deserunt distinctio, neque quisquam. Exercitationem necessitatibus pariatur ullam rem quae, porro unde hic obcaecati, cupiditate ratione tempora, iste veritatis! Distinctio ea harum autem explicabo, quis quae repudiandae at, dolorum eaque culpa aperiam alias. Illum sed ullam dolore, temporibus ducimus odit rem nemo iusto exercitationem corrupti sint explicabo illo officia modi consequuntur, quibusdam culpa, ex excepturi saepe quasi. Quidem esse fuga cupiditate omnis ad rem tenetur, consequatur, accusamus incidunt voluptatibus vero deleniti! At ad nulla iste amet, aliquam alias odit ipsum, quos necessitatibus reprehenderit doloremque vero voluptatem excepturi, doloribus accusamus corporis consequatur sunt nostrum? Sit nisi expedita incidunt qui beatae, quibusdam earum. Consequatur delectus ad beatae! Magni illum reprehenderit quod voluptas officiis dolore, praesentium ea maiores ducimus itaque odio placeat laboriosam ipsum optio et laudantium sint quas. Eveniet distinctio explicabo alias provident autem animi omnis itaque repellendus, maxime excepturi odit officiis neque quam, similique iusto commodi impedit. Eaque quos nam tempora unde nesciunt ab nisi cum saepe hic, maxime obcaecati nostrum consectetur? Vero velit ex, ea culpa dolorem sunt similique optio tenetur dolorum vitae nihil impedit et dolores beatae blanditiis assumenda ipsum ratione. Obcaecati esse ut similique quae dolor, facilis consectetur, harum et optio iure adipisci hic ipsum culpa deleniti alias vitae soluta officiis? Ea ut sint totam hic eius sunt adipisci. Aspernatur quos nulla asperiores reiciendis ab error consectetur odit placeat quisquam tenetur dolore accusantium voluptatum ipsum perspiciatis illo aut eveniet ullam iusto quia blanditiis iste natus possimus, repellendus sed? Id, nulla.',
            'excerp' => 'Peresmian dan Penyerahan Website Desa Detto oleh Pemerintah Desa.',
            'created_at' => '2023-06-01 19:48:47',
        ]);
    }
}
