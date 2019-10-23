## Kecukupan Kas

select DATE_FORMAT(tanggal, "%M %Y") as date, `rekening`, 
       REPLACE(REPLACE(ref_pecahan.label, '.', ''), ',','.'),
       sum(value),
       sum((value / REPLACE(REPLACE(ref_pecahan.label, '.', ''), ',','.')) / 
           (CASE
             WHEN ref_pecahan.type = 'upkl' AND ref_pecahan.label >= 500 THEN 5000
             WHEN ref_pecahan.type = 'upkl' AND ref_pecahan.label >= 100 THEN 10000
             ELSE 20000
           END)
       ) as value
from `trans_posisi_kas` 
INNER JOIN (
    SELECT MAX(tanggal) AS maxdate
    FROM `trans_posisi_kas`
    GROUP BY YEAR(tanggal), MONTH(tanggal)
) x ON `trans_posisi_kas`.tanggal = maxdate
INNER join `ref_kode_pecahan` on `ref_kode_pecahan`.`id` = `trans_posisi_kas`.`kode_pecahan_id` 
INNER join `ref_pecahan` on `ref_pecahan`.`id` = `ref_kode_pecahan`.`pecahan_id` 
INNER join `ref_satker` on `ref_satker`.`id` = `trans_posisi_kas`.`satker_id` 
where `rekening` in ('010','011','012.000','012.001') 
and `satker_id` = 1
and `tanggal` between '2019-01-01' and '2019-03-31' 
and (`ref_satker`.`dpu` != 1 or (`ref_satker`.`dpu` = 1 and `rekening` in ('011', '012.000', '012.001'))) 
group by date, ref_pecahan.label, `rekening` 
order by `tanggal`, rekening, label asc

