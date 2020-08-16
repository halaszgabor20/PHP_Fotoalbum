select count (*), kategoriak_kategorianev from kepek group by kategoriak_kategorianev


select count (*), FELHASZNALO_FELHASZNALONEV from kepek group by FELHASZNALO_FELHASZNALONEV ORDER BY COUNT(KEPEK_ID)DESC;


select count (*), KATEGORIAK_KATEGORIANEV from kepek group by KATEGORIAK_KATEGORIANEV ORDER BY COUNT(KEPEK_ID)DESC;











