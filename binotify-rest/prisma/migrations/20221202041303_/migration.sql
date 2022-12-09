/*
  Warnings:

  - A unique constraint covering the columns `[song_id]` on the table `Song` will be added. If there are existing duplicate values, this will fail.

*/
-- CreateIndex
CREATE UNIQUE INDEX `Song_song_id_key` ON `Song`(`song_id`);
